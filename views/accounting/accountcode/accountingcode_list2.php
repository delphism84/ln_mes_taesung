<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">Forms</a>
				</li>
				<li class="active">Form Elements</li>
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
					계약리스트
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 계약의 리스트를 보여드립니다.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

				<link rel="stylesheet" type="text/css" href="http://erp.ssabu.net/common.css" />
				<style type="text/css">
				.left{float:left;}
				.left_content th, .center_head th{ border:1px solid #878787;background:#969696;color:#FFF;height:20px;}
				.left_content td, .center_content td{border:1px solid #dbdbdb;}
				.left_content td{padding:3px 10px 3px 10px;}
				.center_content td{height:16px;}

				.center, .right{float:left;margin-left:10px;}
				.right{position:absolute;left:615px;top:48px;}
				.th5{width:25px;text-align:center;padding:0;margin:0;}
				.th1{width:40px;text-align:center;}
				.th2{width:130px;}
				.th3{width:82px;}
				.th4{width:90px;}
				.center_content{overflow:auto;height:514px;width:400px;}
				.center_content a:hover{text-decoration:none;}

				.top_ment{color:#FFF;position:absolute;left:510px;top:15px;}
				</style>
				<!-- <script type="text/javascript" src="http://erp.ssabu.net/config/jquery-1.11.2.js"></script>
				<script language="JavaScript" src="http://erp.ssabu.net/config/common.js"></script>
				<script language="JavaScript" src="http://erp.ssabu.net/config/ShowHideLayer.js"></script>
				<script type="text/javascript" src="http://erp.ssabu.net/config/CheckDate.js"></script> -->
				

				<div class="comm_top">
					<ul>
						<li style="padding-left:17px;padding-top:10px;"><img src="/fa/Images/comm/logo.png"></li>
						<li class="comm_top_bg"><span class="comm_title_text">계정과목 및 적요</span></li>
					</ul>
				</div>
				<div class="top_ment">전체 계정과목 미사용(체크해제)하고 사용할 계정과목만 체크하면, 전표입력시 편리합니다.</div>

				<div class="wrap_main">

				<div class="left">
					<div class="left_content">
						<table>
							<tr>
								<th colspan="2">계정체계</th>
							</tr>
						<tr id='Ltr_1' style='background:#FFF'>
							<td onClick="goLoc('1',1)"><span>당좌자산</span> </td>
							<td onClick="goLoc('1',1)">0101-0145</td>
						</tr>
						<input type='hidden' id='systemcode_1' value='1'><tr id='Ltr_2' style='background:#FFF'>
							<td onClick="goLoc('2',2)"><span>재고자산</span> </td>
							<td onClick="goLoc('2',2)">0146-0175</td>
						</tr>
						<input type='hidden' id='systemcode_2' value='2'><tr id='Ltr_3' style='background:#FFF'>
							<td onClick="goLoc('3',3)"><span>투자자산</span> </td>
							<td onClick="goLoc('3',3)">0176-0194</td>
						</tr>
						<input type='hidden' id='systemcode_3' value='3'><tr id='Ltr_4' style='background:#FFF'>
							<td onClick="goLoc('4',4)"><span>유형자산</span> </td>
							<td onClick="goLoc('4',4)">0195-0500</td>
						</tr>
						<input type='hidden' id='systemcode_4' value='4'><tr id='Ltr_5' style='background:#FFF'>
							<td onClick="goLoc('5',5)"><span>무형자산</span> </td>
							<td onClick="goLoc('5',5)">0218-0230</td>
						</tr>
						<input type='hidden' id='systemcode_5' value='5'><tr id='Ltr_6' style='background:#FFF'>
							<td onClick="goLoc('6',6)"><span>기타비유동자산</span> </td>
							<td onClick="goLoc('6',6)">0231-0250</td>
						</tr>
						<input type='hidden' id='systemcode_6' value='6'><tr id='Ltr_7' style='background:#FFF'>
							<td onClick="goLoc('7',7)"><span>유동부채</span> </td>
							<td onClick="goLoc('7',7)">0251-0290</td>
						</tr>
						<input type='hidden' id='systemcode_7' value='7'><tr id='Ltr_8' style='background:#FFF'>
							<td onClick="goLoc('8',8)"><span>비유동부채</span> </td>
							<td onClick="goLoc('8',8)">0291-0330</td>
						</tr>
						<input type='hidden' id='systemcode_8' value='8'><tr id='Ltr_9' style='background:#FFF'>
							<td onClick="goLoc('9',9)"><span>자본금</span> </td>
							<td onClick="goLoc('9',9)">0331-0340</td>
						</tr>
						<input type='hidden' id='systemcode_9' value='9'><tr id='Ltr_10' style='background:#FFF'>
							<td onClick="goLoc('10',10)"><span>자본잉여금</span> </td>
							<td onClick="goLoc('10',10)">0341-0350</td>
						</tr>
						<input type='hidden' id='systemcode_10' value='10'><tr id='Ltr_11' style='background:#FFF'>
							<td onClick="goLoc('11',11)"><span>이익잉여금</span> </td>
							<td onClick="goLoc('11',11)">0351-0380</td>
						</tr>
						<input type='hidden' id='systemcode_11' value='11'><tr id='Ltr_12' style='background:#FFF'>
							<td onClick="goLoc('12',12)"><span>자본조정</span> </td>
							<td onClick="goLoc('12',12)">0381-0391</td>
						</tr>
						<input type='hidden' id='systemcode_12' value='12'><tr id='Ltr_13' style='background:#FFF'>
							<td onClick="goLoc('13',13)"><span>기타포괄손익누계액</span> </td>
							<td onClick="goLoc('13',13)">0392-0399</td>
						</tr>
						<input type='hidden' id='systemcode_13' value='13'><tr id='Ltr_14' style='background:#FFF'>
							<td onClick="goLoc('14',14)"><span>손익</span> </td>
							<td onClick="goLoc('14',14)">0400-0400</td>
						</tr>
						<input type='hidden' id='systemcode_14' value='14'><tr id='Ltr_15' style='background:#FFF'>
							<td onClick="goLoc('15',15)"><span>매출</span> </td>
							<td onClick="goLoc('15',15)">0401-0430</td>
						</tr>
						<input type='hidden' id='systemcode_15' value='15'><tr id='Ltr_16' style='background:#FFF'>
							<td onClick="goLoc('16',16)"><span>매출원가</span> </td>
							<td onClick="goLoc('16',16)">0451-0470</td>
						</tr>
						<input type='hidden' id='systemcode_16' value='16'><tr id='Ltr_17' style='background:#FFF'>
							<td onClick="goLoc('17',17)"><span>제조원가</span> <span id='use_3'><font onClick="setSave('3','N','17')">(사용 여)</font></span></td>
							<td onClick="goLoc('17',17)">0501-0600</td>
						</tr>
						<input type='hidden' id='systemcode_17' value='17'><tr id='Ltr_18' style='background:#FFF'>
							<td onClick="goLoc('18',18)"><span>도급원가</span> <span id='use_4'><font onClick="setSave('4','Y','18')" style='color:blue'>(사용 부)<font></span></td>
							<td onClick="goLoc('18',18)">0601-0650</td>
						</tr>
						<input type='hidden' id='systemcode_18' value='18'><tr id='Ltr_19' style='background:#FFF'>
							<td onClick="goLoc('19',19)"><span>보관원가</span> <span id='use_5'><font onClick="setSave('5','N','19')">(사용 여)</font></span></td>
							<td onClick="goLoc('19',19)">0651-0700</td>
						</tr>
						<input type='hidden' id='systemcode_19' value='19'><tr id='Ltr_20' style='background:#FFF'>
							<td onClick="goLoc('20',20)"><span>분양원가</span> <span id='use_6'><font onClick="setSave('6','N','20')">(사용 여)</font></span></td>
							<td onClick="goLoc('20',20)">0701-0750</td>
						</tr>
						<input type='hidden' id='systemcode_20' value='20'><tr id='Ltr_21' style='background:#FFF'>
							<td onClick="goLoc('21',21)"><span>운송원가</span> <span id='use_7'><font onClick="setSave('7','N','21')">(사용 여)</font></span></td>
							<td onClick="goLoc('21',21)">0751-0800</td>
						</tr>
						<input type='hidden' id='systemcode_21' value='21'><tr id='Ltr_22' style='background:#FFF'>
							<td onClick="goLoc('22',22)"><span>판매비및일반관리비</span> </td>
							<td onClick="goLoc('22',22)">0801-0900</td>
						</tr>
						<input type='hidden' id='systemcode_22' value='22'><tr id='Ltr_23' style='background:#FFF'>
							<td onClick="goLoc('23',23)"><span>영업외수익</span> </td>
							<td onClick="goLoc('23',23)">0901-0950</td>
						</tr>
						<input type='hidden' id='systemcode_23' value='23'><tr id='Ltr_24' style='background:#FFF'>
							<td onClick="goLoc('24',24)"><span>영업외비용</span> </td>
							<td onClick="goLoc('24',24)">0951-0997</td>
						</tr>
						<input type='hidden' id='systemcode_24' value='24'><tr id='Ltr_25' style='background:#FFF'>
							<td onClick="goLoc('25',25)"><span>법인(소득)세등</span> </td>
							<td onClick="goLoc('25',25)">0998-0999</td>
						</tr>
						<input type='hidden' id='systemcode_25' value='25'>			<tr>
								<td colspan="2" style="height:20px;color:#ec4261;border-left:0;border-right:0;border-bottom:0;background:#f4f4f4;">※ 빨간색부분은 수정이 되지 않습니다.</td>
							</tr>
						</table>
					</div>
				</div>
				<input type="hidden" id="Lnum" value="26">

				<form name="acc_hidden" method="post">
				<div class="center">
					<div class="center_head">
						<table>
							<tr>
								<th class="th5"><input type="checkbox" id="chkall" checked onClick="chk_all()"></th>
								<th class="th1">코드</th>
								<th class="th2">계정과목</th>
								<th class="th3">성격</th>
								<th class="th4">관계</th>
							</tr>
						</table>
					</div>
					<div class="center_content">
						<table>
						<tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_1' id='S_1' style='height:12px' value='Y' onClick="chk_Scode('1')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='1'>당좌자산</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_1' onClick="goDetail('010100',1)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_1' id='chk_1' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0101</td>
							<td class='th2' style='color:#ec4261' id='td_accName_1'>현금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_1'>3.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_1'></td>
						</tr>
						<input type='hidden' id='Scode_1' value='1'>
						<input type='hidden' name='code_1' value='010100'><tr id='tr_2' onClick="goDetail('010200',2)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_2' id='chk_2' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0102</td>
							<td class='th2' style='color:#ec4261' id='td_accName_2'>당좌예금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_2'>1.예금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_2'></td>
						</tr>
						<input type='hidden' id='Scode_2' value='1'>
						<input type='hidden' name='code_2' value='010200'><tr id='tr_3' onClick="goDetail('010300',3)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_3' id='chk_3' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0103</td>
							<td class='th2' style='color:#ec4261' id='td_accName_3'>보통예금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_3'>1.예금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_3'></td>
						</tr>
						<input type='hidden' id='Scode_3' value='1'>
						<input type='hidden' name='code_3' value='010300'><tr id='tr_4' onClick="goDetail('010400',4)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_4' id='chk_4' style='height:12px' value='Y' checked></td>
							<td class='th1' >0104</td>
							<td class='th2'  id='td_accName_4'>제예금 </td>
							<td class='th3'  id='td_chr_4'>1.예금</td>
							<td class='th4'  id='td_relname_4'></td>
						</tr>
						<input type='hidden' id='Scode_4' value='1'>
						<input type='hidden' name='code_4' value='010400'><tr id='tr_5' onClick="goDetail('010500',5)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_5' id='chk_5' style='height:12px' value='Y' checked></td>
							<td class='th1' >0105</td>
							<td class='th2'  id='td_accName_5'>정기예금 </td>
							<td class='th3'  id='td_chr_5'>1.예금</td>
							<td class='th4'  id='td_relname_5'></td>
						</tr>
						<input type='hidden' id='Scode_5' value='1'>
						<input type='hidden' name='code_5' value='010500'><tr id='tr_6' onClick="goDetail('010600',6)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_6' id='chk_6' style='height:12px' value='Y' checked></td>
							<td class='th1' >0106</td>
							<td class='th2'  id='td_accName_6'>정기적금 </td>
							<td class='th3'  id='td_chr_6'>2.적금</td>
							<td class='th4'  id='td_relname_6'></td>
						</tr>
						<input type='hidden' id='Scode_6' value='1'>
						<input type='hidden' name='code_6' value='010600'><tr id='tr_7' onClick="goDetail('010700',7)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_7' id='chk_7' style='height:12px' value='Y' checked></td>
							<td class='th1' >0107</td>
							<td class='th2'  id='td_accName_7'>단기매매증권 </td>
							<td class='th3'  id='td_chr_7'>5.유가증권</td>
							<td class='th4'  id='td_relname_7'></td>
						</tr>
						<input type='hidden' id='Scode_7' value='1'>
						<input type='hidden' name='code_7' value='010700'><tr id='tr_8' onClick="goDetail('010800',8)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_8' id='chk_8' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0108</td>
							<td class='th2' style='color:#ec4261' id='td_accName_8'>외상매출금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_8'>3.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_8'></td>
						</tr>
						<input type='hidden' id='Scode_8' value='1'>
						<input type='hidden' name='code_8' value='010800'><tr id='tr_9' onClick="goDetail('010900',9)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_9' id='chk_9' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0109</td>
							<td class='th2' style='color:#ec4261' id='td_accName_9'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_9'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_9'>외상매출금</td>
						</tr>
						<input type='hidden' id='Scode_9' value='1'>
						<input type='hidden' name='code_9' value='010900'><tr id='tr_10' onClick="goDetail('011000',10)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_10' id='chk_10' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0110</td>
							<td class='th2' style='color:#ec4261' id='td_accName_10'>받을어음 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_10'>8.받을어음</td>
							<td class='th4' style='color:#ec4261' id='td_relname_10'></td>
						</tr>
						<input type='hidden' id='Scode_10' value='1'>
						<input type='hidden' name='code_10' value='011000'><tr id='tr_11' onClick="goDetail('011100',11)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_11' id='chk_11' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0111</td>
							<td class='th2' style='color:#ec4261' id='td_accName_11'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_11'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_11'>받을어음</td>
						</tr>
						<input type='hidden' id='Scode_11' value='1'>
						<input type='hidden' name='code_11' value='011100'><tr id='tr_12' onClick="goDetail('011200',12)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_12' id='chk_12' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0112</td>
							<td class='th2' style='color:#ec4261' id='td_accName_12'>공사미수금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_12'>3.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_12'></td>
						</tr>
						<input type='hidden' id='Scode_12' value='1'>
						<input type='hidden' name='code_12' value='011200'><tr id='tr_13' onClick="goDetail('011300',13)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_13' id='chk_13' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0113</td>
							<td class='th2' style='color:#ec4261' id='td_accName_13'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_13'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_13'>공사미수금</td>
						</tr>
						<input type='hidden' id='Scode_13' value='1'>
						<input type='hidden' name='code_13' value='011300'><tr id='tr_14' onClick="goDetail('011400',14)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_14' id='chk_14' style='height:12px' value='Y' checked></td>
							<td class='th1' >0114</td>
							<td class='th2'  id='td_accName_14'>단기대여금 </td>
							<td class='th3'  id='td_chr_14'>9.대여금</td>
							<td class='th4'  id='td_relname_14'></td>
						</tr>
						<input type='hidden' id='Scode_14' value='1'>
						<input type='hidden' name='code_14' value='011400'><tr id='tr_15' onClick="goDetail('011500',15)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_15' id='chk_15' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0115</td>
							<td class='th2' style='color:#ec4261' id='td_accName_15'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_15'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_15'>단기대여금</td>
						</tr>
						<input type='hidden' id='Scode_15' value='1'>
						<input type='hidden' name='code_15' value='011500'><tr id='tr_16' onClick="goDetail('011600',16)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_16' id='chk_16' style='height:12px' value='Y' checked></td>
							<td class='th1' >0116</td>
							<td class='th2'  id='td_accName_16'>미수수익 </td>
							<td class='th3'  id='td_chr_16'>3.일반</td>
							<td class='th4'  id='td_relname_16'></td>
						</tr>
						<input type='hidden' id='Scode_16' value='1'>
						<input type='hidden' name='code_16' value='011600'><tr id='tr_17' onClick="goDetail('011700',17)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_17' id='chk_17' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0117</td>
							<td class='th2' style='color:#ec4261' id='td_accName_17'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_17'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_17'>미수수익</td>
						</tr>
						<input type='hidden' id='Scode_17' value='1'>
						<input type='hidden' name='code_17' value='011700'><tr id='tr_18' onClick="goDetail('011800',18)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_18' id='chk_18' style='height:12px' value='Y' checked></td>
							<td class='th1' >0118</td>
							<td class='th2'  id='td_accName_18'>분양미수금 </td>
							<td class='th3'  id='td_chr_18'>3.일반</td>
							<td class='th4'  id='td_relname_18'></td>
						</tr>
						<input type='hidden' id='Scode_18' value='1'>
						<input type='hidden' name='code_18' value='011800'><tr id='tr_19' onClick="goDetail('011900',19)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_19' id='chk_19' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0119</td>
							<td class='th2' style='color:#ec4261' id='td_accName_19'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_19'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_19'>분양미수금</td>
						</tr>
						<input type='hidden' id='Scode_19' value='1'>
						<input type='hidden' name='code_19' value='011900'><tr id='tr_20' onClick="goDetail('012000',20)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_20' id='chk_20' style='height:12px' value='Y' checked></td>
							<td class='th1' >0120</td>
							<td class='th2'  id='td_accName_20'>미수금 </td>
							<td class='th3'  id='td_chr_20'>3.일반</td>
							<td class='th4'  id='td_relname_20'></td>
						</tr>
						<input type='hidden' id='Scode_20' value='1'>
						<input type='hidden' name='code_20' value='012000'><tr id='tr_21' onClick="goDetail('012100',21)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_21' id='chk_21' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0121</td>
							<td class='th2' style='color:#ec4261' id='td_accName_21'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_21'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_21'>미수금</td>
						</tr>
						<input type='hidden' id='Scode_21' value='1'>
						<input type='hidden' name='code_21' value='012100'><tr id='tr_22' onClick="goDetail('012200',22)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_22' id='chk_22' style='height:12px' value='Y' checked></td>
							<td class='th1' >0122</td>
							<td class='th2'  id='td_accName_22'>체크카드미정산 </td>
							<td class='th3'  id='td_chr_22'>3.일반</td>
							<td class='th4'  id='td_relname_22'></td>
						</tr>
						<input type='hidden' id='Scode_22' value='1'>
						<input type='hidden' name='code_22' value='012200'><tr id='tr_23' onClick="goDetail('012300',23)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_23' id='chk_23' style='height:12px' value='Y' checked></td>
							<td class='th1' >0123</td>
							<td class='th2'  id='td_accName_23'>매도가능증권 </td>
							<td class='th3'  id='td_chr_23'>5.유가증권</td>
							<td class='th4'  id='td_relname_23'></td>
						</tr>
						<input type='hidden' id='Scode_23' value='1'>
						<input type='hidden' name='code_23' value='012300'><tr id='tr_24' onClick="goDetail('012400',24)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_24' id='chk_24' style='height:12px' value='Y' checked></td>
							<td class='th1' >0124</td>
							<td class='th2'  id='td_accName_24'>만기보유증권 </td>
							<td class='th3'  id='td_chr_24'>5.유가증권</td>
							<td class='th4'  id='td_relname_24'></td>
						</tr>
						<input type='hidden' id='Scode_24' value='1'>
						<input type='hidden' name='code_24' value='012400'><tr id='tr_25' onClick="goDetail('012500',25)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_25' id='chk_25' style='height:12px' value='Y' checked></td>
							<td class='th1' >0125</td>
							<td class='th2'  id='td_accName_25'>용역미수금 </td>
							<td class='th3'  id='td_chr_25'>3.일반</td>
							<td class='th4'  id='td_relname_25'></td>
						</tr>
						<input type='hidden' id='Scode_25' value='1'>
						<input type='hidden' name='code_25' value='012500'><tr id='tr_26' onClick="goDetail('012600',26)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_26' id='chk_26' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0126</td>
							<td class='th2' style='color:#ec4261' id='td_accName_26'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_26'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_26'>용역미수금</td>
						</tr>
						<input type='hidden' id='Scode_26' value='1'>
						<input type='hidden' name='code_26' value='012600'><tr id='tr_27' onClick="goDetail('012700',27)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_27' id='chk_27' style='height:12px' value='Y' checked></td>
							<td class='th1' >0127</td>
							<td class='th2'  id='td_accName_27'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_27'></td>
							<td class='th4'  id='td_relname_27'></td>
						</tr>
						<input type='hidden' id='Scode_27' value='1'>
						<input type='hidden' name='code_27' value='012700'><tr id='tr_28' onClick="goDetail('012800',28)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_28' id='chk_28' style='height:12px' value='Y' checked></td>
							<td class='th1' >0128</td>
							<td class='th2'  id='td_accName_28'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_28'></td>
							<td class='th4'  id='td_relname_28'></td>
						</tr>
						<input type='hidden' id='Scode_28' value='1'>
						<input type='hidden' name='code_28' value='012800'><tr id='tr_29' onClick="goDetail('012900',29)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_29' id='chk_29' style='height:12px' value='Y' checked></td>
							<td class='th1' >0129</td>
							<td class='th2'  id='td_accName_29'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_29'></td>
							<td class='th4'  id='td_relname_29'></td>
						</tr>
						<input type='hidden' id='Scode_29' value='1'>
						<input type='hidden' name='code_29' value='012900'><tr id='tr_30' onClick="goDetail('013000',30)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_30' id='chk_30' style='height:12px' value='Y' checked></td>
							<td class='th1' >0130</td>
							<td class='th2'  id='td_accName_30'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_30'></td>
							<td class='th4'  id='td_relname_30'></td>
						</tr>
						<input type='hidden' id='Scode_30' value='1'>
						<input type='hidden' name='code_30' value='013000'><tr id='tr_31' onClick="goDetail('013100',31)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_31' id='chk_31' style='height:12px' value='Y' checked></td>
							<td class='th1' >0131</td>
							<td class='th2'  id='td_accName_31'>선급금 </td>
							<td class='th3'  id='td_chr_31'>3.일반</td>
							<td class='th4'  id='td_relname_31'></td>
						</tr>
						<input type='hidden' id='Scode_31' value='1'>
						<input type='hidden' name='code_31' value='013100'><tr id='tr_32' onClick="goDetail('013200',32)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_32' id='chk_32' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0132</td>
							<td class='th2' style='color:#ec4261' id='td_accName_32'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_32'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_32'>선급금</td>
						</tr>
						<input type='hidden' id='Scode_32' value='1'>
						<input type='hidden' name='code_32' value='013200'><tr id='tr_33' onClick="goDetail('013300',33)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_33' id='chk_33' style='height:12px' value='Y' checked></td>
							<td class='th1' >0133</td>
							<td class='th2'  id='td_accName_33'>선급비용 </td>
							<td class='th3'  id='td_chr_33'>3.일반</td>
							<td class='th4'  id='td_relname_33'></td>
						</tr>
						<input type='hidden' id='Scode_33' value='1'>
						<input type='hidden' name='code_33' value='013300'><tr id='tr_34' onClick="goDetail('013400',34)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_34' id='chk_34' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0134</td>
							<td class='th2' style='color:#ec4261' id='td_accName_34'>가지급금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_34'>7.가지급금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_34'></td>
						</tr>
						<input type='hidden' id='Scode_34' value='1'>
						<input type='hidden' name='code_34' value='013400'><tr id='tr_35' onClick="goDetail('013500',35)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_35' id='chk_35' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0135</td>
							<td class='th2' style='color:#ec4261' id='td_accName_35'>부가세대급금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_35'>3.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_35'></td>
						</tr>
						<input type='hidden' id='Scode_35' value='1'>
						<input type='hidden' name='code_35' value='013500'><tr id='tr_36' onClick="goDetail('013600',36)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_36' id='chk_36' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0136</td>
							<td class='th2' style='color:#ec4261' id='td_accName_36'>선납세금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_36'>3.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_36'></td>
						</tr>
						<input type='hidden' id='Scode_36' value='1'>
						<input type='hidden' name='code_36' value='013600'><tr id='tr_37' onClick="goDetail('013700',37)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_37' id='chk_37' style='height:12px' value='Y' checked></td>
							<td class='th1' >0137</td>
							<td class='th2'  id='td_accName_37'>주임종단기채권 </td>
							<td class='th3'  id='td_chr_37'>3.일반</td>
							<td class='th4'  id='td_relname_37'></td>
						</tr>
						<input type='hidden' id='Scode_37' value='1'>
						<input type='hidden' name='code_37' value='013700'><tr id='tr_38' onClick="goDetail('013800',38)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_38' id='chk_38' style='height:12px' value='Y' checked></td>
							<td class='th1' >0138</td>
							<td class='th2'  id='td_accName_38'>전도금 </td>
							<td class='th3'  id='td_chr_38'>3.일반</td>
							<td class='th4'  id='td_relname_38'></td>
						</tr>
						<input type='hidden' id='Scode_38' value='1'>
						<input type='hidden' name='code_38' value='013800'><tr id='tr_39' onClick="goDetail('013900',39)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_39' id='chk_39' style='height:12px' value='Y' checked></td>
							<td class='th1' >0139</td>
							<td class='th2'  id='td_accName_39'>선급공사비 </td>
							<td class='th3'  id='td_chr_39'>3.일반</td>
							<td class='th4'  id='td_relname_39'></td>
						</tr>
						<input type='hidden' id='Scode_39' value='1'>
						<input type='hidden' name='code_39' value='013900'><tr id='tr_40' onClick="goDetail('014000',40)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_40' id='chk_40' style='height:12px' value='Y' checked></td>
							<td class='th1' >0140</td>
							<td class='th2'  id='td_accName_40'>이연법인세자산 </td>
							<td class='th3'  id='td_chr_40'>3.일반</td>
							<td class='th4'  id='td_relname_40'></td>
						</tr>
						<input type='hidden' id='Scode_40' value='1'>
						<input type='hidden' name='code_40' value='014000'><tr id='tr_41' onClick="goDetail('014100',41)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_41' id='chk_41' style='height:12px' value='Y' checked></td>
							<td class='th1' >0141</td>
							<td class='th2'  id='td_accName_41'>현금과부족 </td>
							<td class='th3'  id='td_chr_41'>3.일반</td>
							<td class='th4'  id='td_relname_41'></td>
						</tr>
						<input type='hidden' id='Scode_41' value='1'>
						<input type='hidden' name='code_41' value='014100'><tr id='tr_42' onClick="goDetail('014200',42)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_42' id='chk_42' style='height:12px' value='Y' checked></td>
							<td class='th1' >0142</td>
							<td class='th2'  id='td_accName_42'>미결산 </td>
							<td class='th3'  id='td_chr_42'>3.일반</td>
							<td class='th4'  id='td_relname_42'></td>
						</tr>
						<input type='hidden' id='Scode_42' value='1'>
						<input type='hidden' name='code_42' value='014200'><tr id='tr_43' onClick="goDetail('014300',43)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_43' id='chk_43' style='height:12px' value='Y' checked></td>
							<td class='th1' >0143</td>
							<td class='th2'  id='td_accName_43'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_43'>3.일반</td>
							<td class='th4'  id='td_relname_43'></td>
						</tr>
						<input type='hidden' id='Scode_43' value='1'>
						<input type='hidden' name='code_43' value='014300'><tr id='tr_44' onClick="goDetail('014400',44)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_44' id='chk_44' style='height:12px' value='Y' checked></td>
							<td class='th1' >0144</td>
							<td class='th2'  id='td_accName_44'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_44'>3.일반</td>
							<td class='th4'  id='td_relname_44'></td>
						</tr>
						<input type='hidden' id='Scode_44' value='1'>
						<input type='hidden' name='code_44' value='014400'><tr id='tr_45' onClick="goDetail('014500',45)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_45' id='chk_45' style='height:12px' value='Y' checked></td>
							<td class='th1' >0145</td>
							<td class='th2'  id='td_accName_45'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_45'>3.일반</td>
							<td class='th4'  id='td_relname_45'></td>
						</tr>
						<input type='hidden' id='Scode_45' value='1'>
						<input type='hidden' name='code_45' value='014500'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_2' id='S_2' style='height:12px' value='Y' onClick="chk_Scode('2')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='2'>재고자산</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_46' onClick="goDetail('014600',46)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_46' id='chk_46' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0146</td>
							<td class='th2' style='color:#ec4261' id='td_accName_46'>상품 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_46'>1.일반재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_46'></td>
						</tr>
						<input type='hidden' id='Scode_46' value='2'>
						<input type='hidden' name='code_46' value='014600'><tr id='tr_47' onClick="goDetail('014700',47)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_47' id='chk_47' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0147</td>
							<td class='th2' style='color:#ec4261' id='td_accName_47'>매입환출및에누리 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_47'>3.환출차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_47'>상품</td>
						</tr>
						<input type='hidden' id='Scode_47' value='2'>
						<input type='hidden' name='code_47' value='014700'><tr id='tr_48' onClick="goDetail('014800',48)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_48' id='chk_48' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0148</td>
							<td class='th2' style='color:#ec4261' id='td_accName_48'>매입할인 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_48'>4.할인차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_48'>상품</td>
						</tr>
						<input type='hidden' id='Scode_48' value='2'>
						<input type='hidden' name='code_48' value='014800'><tr id='tr_49' onClick="goDetail('014900',49)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_49' id='chk_49' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0149</td>
							<td class='th2' style='color:#ec4261' id='td_accName_49'>관세환급금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_49'>5.관세차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_49'>상품</td>
						</tr>
						<input type='hidden' id='Scode_49' value='2'>
						<input type='hidden' name='code_49' value='014900'><tr id='tr_50' onClick="goDetail('015000',50)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_50' id='chk_50' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0150</td>
							<td class='th2' style='color:#ec4261' id='td_accName_50'>제품 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_50'>1.일반재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_50'></td>
						</tr>
						<input type='hidden' id='Scode_50' value='2'>
						<input type='hidden' name='code_50' value='015000'><tr id='tr_51' onClick="goDetail('015100',51)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_51' id='chk_51' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0151</td>
							<td class='th2' style='color:#ec4261' id='td_accName_51'>관세환급금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_51'>5.관세차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_51'>제품</td>
						</tr>
						<input type='hidden' id='Scode_51' value='2'>
						<input type='hidden' name='code_51' value='015100'><tr id='tr_52' onClick="goDetail('015200',52)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_52' id='chk_52' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0152</td>
							<td class='th2' style='color:#ec4261' id='td_accName_52'>완성건물 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_52'>1.일반재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_52'></td>
						</tr>
						<input type='hidden' id='Scode_52' value='2'>
						<input type='hidden' name='code_52' value='015200'><tr id='tr_53' onClick="goDetail('015300',53)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_53' id='chk_53' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0153</td>
							<td class='th2' style='color:#ec4261' id='td_accName_53'>원재료 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_53'>1.일반재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_53'></td>
						</tr>
						<input type='hidden' id='Scode_53' value='2'>
						<input type='hidden' name='code_53' value='015300'><tr id='tr_54' onClick="goDetail('015400',54)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_54' id='chk_54' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0154</td>
							<td class='th2' style='color:#ec4261' id='td_accName_54'>매입환출및에누리 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_54'>3.환출차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_54'>원재료</td>
						</tr>
						<input type='hidden' id='Scode_54' value='2'>
						<input type='hidden' name='code_54' value='015400'><tr id='tr_55' onClick="goDetail('015500',55)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_55' id='chk_55' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0155</td>
							<td class='th2' style='color:#ec4261' id='td_accName_55'>매입할인 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_55'>4.할인차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_55'>원재료</td>
						</tr>
						<input type='hidden' id='Scode_55' value='2'>
						<input type='hidden' name='code_55' value='015500'><tr id='tr_56' onClick="goDetail('015600',56)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_56' id='chk_56' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0156</td>
							<td class='th2' style='color:#ec4261' id='td_accName_56'>원재료(도급) </td>
							<td class='th3' style='color:#ec4261' id='td_chr_56'>1.일반재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_56'></td>
						</tr>
						<input type='hidden' id='Scode_56' value='2'>
						<input type='hidden' name='code_56' value='015600'><tr id='tr_57' onClick="goDetail('015700',57)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_57' id='chk_57' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0157</td>
							<td class='th2' style='color:#ec4261' id='td_accName_57'>매입환출및에누리 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_57'>3.환출차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_57'>원재료(도급)</td>
						</tr>
						<input type='hidden' id='Scode_57' value='2'>
						<input type='hidden' name='code_57' value='015700'><tr id='tr_58' onClick="goDetail('015800',58)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_58' id='chk_58' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0158</td>
							<td class='th2' style='color:#ec4261' id='td_accName_58'>매입할인 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_58'>4.할인차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_58'>원재료(도급)</td>
						</tr>
						<input type='hidden' id='Scode_58' value='2'>
						<input type='hidden' name='code_58' value='015800'><tr id='tr_59' onClick="goDetail('015900',59)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_59' id='chk_59' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0159</td>
							<td class='th2' style='color:#ec4261' id='td_accName_59'>원재료(분양) </td>
							<td class='th3' style='color:#ec4261' id='td_chr_59'>1.일반재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_59'></td>
						</tr>
						<input type='hidden' id='Scode_59' value='2'>
						<input type='hidden' name='code_59' value='015900'><tr id='tr_60' onClick="goDetail('016000',60)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_60' id='chk_60' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0160</td>
							<td class='th2' style='color:#ec4261' id='td_accName_60'>매입환출및에누리 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_60'>3.환출차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_60'>원재료(분양)</td>
						</tr>
						<input type='hidden' id='Scode_60' value='2'>
						<input type='hidden' name='code_60' value='016000'><tr id='tr_61' onClick="goDetail('016100',61)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_61' id='chk_61' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0161</td>
							<td class='th2' style='color:#ec4261' id='td_accName_61'>매입할인 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_61'>4.할인차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_61'>원재료(분양)</td>
						</tr>
						<input type='hidden' id='Scode_61' value='2'>
						<input type='hidden' name='code_61' value='016100'><tr id='tr_62' onClick="goDetail('016200',62)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_62' id='chk_62' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0162</td>
							<td class='th2' style='color:#ec4261' id='td_accName_62'>부재료 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_62'>1.일반재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_62'></td>
						</tr>
						<input type='hidden' id='Scode_62' value='2'>
						<input type='hidden' name='code_62' value='016200'><tr id='tr_63' onClick="goDetail('016300',63)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_63' id='chk_63' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0163</td>
							<td class='th2' style='color:#ec4261' id='td_accName_63'>매입환출및에누리 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_63'>3.환출차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_63'>부재료</td>
						</tr>
						<input type='hidden' id='Scode_63' value='2'>
						<input type='hidden' name='code_63' value='016300'><tr id='tr_64' onClick="goDetail('016400',64)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_64' id='chk_64' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0164</td>
							<td class='th2' style='color:#ec4261' id='td_accName_64'>매입할인 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_64'>4.할인차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_64'>부재료</td>
						</tr>
						<input type='hidden' id='Scode_64' value='2'>
						<input type='hidden' name='code_64' value='016400'><tr id='tr_65' onClick="goDetail('016500',65)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_65' id='chk_65' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0165</td>
							<td class='th2' style='color:#ec4261' id='td_accName_65'>건설용지 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_65'>1.일반재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_65'></td>
						</tr>
						<input type='hidden' id='Scode_65' value='2'>
						<input type='hidden' name='code_65' value='016500'><tr id='tr_66' onClick="goDetail('016600',66)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_66' id='chk_66' style='height:12px' value='Y' checked></td>
							<td class='th1' >0166</td>
							<td class='th2'  id='td_accName_66'>가설재 </td>
							<td class='th3'  id='td_chr_66'>1.일반재고</td>
							<td class='th4'  id='td_relname_66'></td>
						</tr>
						<input type='hidden' id='Scode_66' value='2'>
						<input type='hidden' name='code_66' value='016600'><tr id='tr_67' onClick="goDetail('016700',67)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_67' id='chk_67' style='height:12px' value='Y' checked></td>
							<td class='th1' >0167</td>
							<td class='th2'  id='td_accName_67'>저장품 </td>
							<td class='th3'  id='td_chr_67'>1.일반재고</td>
							<td class='th4'  id='td_relname_67'></td>
						</tr>
						<input type='hidden' id='Scode_67' value='2'>
						<input type='hidden' name='code_67' value='016700'><tr id='tr_68' onClick="goDetail('016800',68)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_68' id='chk_68' style='height:12px' value='Y' checked></td>
							<td class='th1' >0168</td>
							<td class='th2'  id='td_accName_68'>미착품 </td>
							<td class='th3'  id='td_chr_68'>1.일반재고</td>
							<td class='th4'  id='td_relname_68'></td>
						</tr>
						<input type='hidden' id='Scode_68' value='2'>
						<input type='hidden' name='code_68' value='016800'><tr id='tr_69' onClick="goDetail('016900',69)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_69' id='chk_69' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0169</td>
							<td class='th2' style='color:#ec4261' id='td_accName_69'>재공품 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_69'>2.공정재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_69'></td>
						</tr>
						<input type='hidden' id='Scode_69' value='2'>
						<input type='hidden' name='code_69' value='016900'><tr id='tr_70' onClick="goDetail('017000',70)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_70' id='chk_70' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0170</td>
							<td class='th2' style='color:#ec4261' id='td_accName_70'>미완성공사(도급) </td>
							<td class='th3' style='color:#ec4261' id='td_chr_70'>2.공정재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_70'></td>
						</tr>
						<input type='hidden' id='Scode_70' value='2'>
						<input type='hidden' name='code_70' value='017000'><tr id='tr_71' onClick="goDetail('017100',71)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_71' id='chk_71' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0171</td>
							<td class='th2' style='color:#ec4261' id='td_accName_71'>미완성공사(분양) </td>
							<td class='th3' style='color:#ec4261' id='td_chr_71'>2.공정재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_71'></td>
						</tr>
						<input type='hidden' id='Scode_71' value='2'>
						<input type='hidden' name='code_71' value='017100'><tr id='tr_72' onClick="goDetail('017200',72)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_72' id='chk_72' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0172</td>
							<td class='th2' style='color:#ec4261' id='td_accName_72'>유류 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_72'>1.일반재고</td>
							<td class='th4' style='color:#ec4261' id='td_relname_72'></td>
						</tr>
						<input type='hidden' id='Scode_72' value='2'>
						<input type='hidden' name='code_72' value='017200'><tr id='tr_73' onClick="goDetail('017300',73)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_73' id='chk_73' style='height:12px' value='Y' checked></td>
							<td class='th1' >0173</td>
							<td class='th2'  id='td_accName_73'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_73'></td>
							<td class='th4'  id='td_relname_73'></td>
						</tr>
						<input type='hidden' id='Scode_73' value='2'>
						<input type='hidden' name='code_73' value='017300'><tr id='tr_74' onClick="goDetail('017400',74)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_74' id='chk_74' style='height:12px' value='Y' checked></td>
							<td class='th1' >0174</td>
							<td class='th2'  id='td_accName_74'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_74'></td>
							<td class='th4'  id='td_relname_74'></td>
						</tr>
						<input type='hidden' id='Scode_74' value='2'>
						<input type='hidden' name='code_74' value='017400'><tr id='tr_75' onClick="goDetail('017500',75)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_75' id='chk_75' style='height:12px' value='Y' checked></td>
							<td class='th1' >0175</td>
							<td class='th2'  id='td_accName_75'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_75'></td>
							<td class='th4'  id='td_relname_75'></td>
						</tr>
						<input type='hidden' id='Scode_75' value='2'>
						<input type='hidden' name='code_75' value='017500'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_3' id='S_3' style='height:12px' value='Y' onClick="chk_Scode('3')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='3'>투자자산</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_76' onClick="goDetail('017600',76)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_76' id='chk_76' style='height:12px' value='Y' checked></td>
							<td class='th1' >0176</td>
							<td class='th2'  id='td_accName_76'>장기성예금 </td>
							<td class='th3'  id='td_chr_76'>1.예금</td>
							<td class='th4'  id='td_relname_76'></td>
						</tr>
						<input type='hidden' id='Scode_76' value='3'>
						<input type='hidden' name='code_76' value='017600'><tr id='tr_77' onClick="goDetail('017700',77)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_77' id='chk_77' style='height:12px' value='Y' checked></td>
							<td class='th1' >0177</td>
							<td class='th2'  id='td_accName_77'>특정현금과예금 </td>
							<td class='th3'  id='td_chr_77'>1.예금</td>
							<td class='th4'  id='td_relname_77'></td>
						</tr>
						<input type='hidden' id='Scode_77' value='3'>
						<input type='hidden' name='code_77' value='017700'><tr id='tr_78' onClick="goDetail('017800',78)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_78' id='chk_78' style='height:12px' value='Y' checked></td>
							<td class='th1' >0178</td>
							<td class='th2'  id='td_accName_78'>매도가능증권 </td>
							<td class='th3'  id='td_chr_78'>5.유가증권</td>
							<td class='th4'  id='td_relname_78'></td>
						</tr>
						<input type='hidden' id='Scode_78' value='3'>
						<input type='hidden' name='code_78' value='017800'><tr id='tr_79' onClick="goDetail('017900',79)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_79' id='chk_79' style='height:12px' value='Y' checked></td>
							<td class='th1' >0179</td>
							<td class='th2'  id='td_accName_79'>장기대여금 </td>
							<td class='th3'  id='td_chr_79'>9.대여금</td>
							<td class='th4'  id='td_relname_79'></td>
						</tr>
						<input type='hidden' id='Scode_79' value='3'>
						<input type='hidden' name='code_79' value='017900'><tr id='tr_80' onClick="goDetail('018000',80)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_80' id='chk_80' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0180</td>
							<td class='th2' style='color:#ec4261' id='td_accName_80'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_80'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_80'>장기대여금</td>
						</tr>
						<input type='hidden' id='Scode_80' value='3'>
						<input type='hidden' name='code_80' value='018000'><tr id='tr_81' onClick="goDetail('018100',81)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_81' id='chk_81' style='height:12px' value='Y' checked></td>
							<td class='th1' >0181</td>
							<td class='th2'  id='td_accName_81'>만기보유증권 </td>
							<td class='th3'  id='td_chr_81'>5.유가증권</td>
							<td class='th4'  id='td_relname_81'></td>
						</tr>
						<input type='hidden' id='Scode_81' value='3'>
						<input type='hidden' name='code_81' value='018100'><tr id='tr_82' onClick="goDetail('018200',82)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_82' id='chk_82' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0182</td>
							<td class='th2' style='color:#ec4261' id='td_accName_82'>지분법적용투자주식 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_82'>3.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_82'></td>
						</tr>
						<input type='hidden' id='Scode_82' value='3'>
						<input type='hidden' name='code_82' value='018200'><tr id='tr_83' onClick="goDetail('018300',83)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_83' id='chk_83' style='height:12px' value='Y' checked></td>
							<td class='th1' >0183</td>
							<td class='th2'  id='td_accName_83'>투자부동산 </td>
							<td class='th3'  id='td_chr_83'>3.일반</td>
							<td class='th4'  id='td_relname_83'></td>
						</tr>
						<input type='hidden' id='Scode_83' value='3'>
						<input type='hidden' name='code_83' value='018300'><tr id='tr_84' onClick="goDetail('018400',84)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_84' id='chk_84' style='height:12px' value='Y' checked></td>
							<td class='th1' >0184</td>
							<td class='th2'  id='td_accName_84'>단체퇴직보험예치금 </td>
							<td class='th3'  id='td_chr_84'>3.일반</td>
							<td class='th4'  id='td_relname_84'></td>
						</tr>
						<input type='hidden' id='Scode_84' value='3'>
						<input type='hidden' name='code_84' value='018400'><tr id='tr_85' onClick="goDetail('018500',85)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_85' id='chk_85' style='height:12px' value='Y' checked></td>
							<td class='th1' >0185</td>
							<td class='th2'  id='td_accName_85'>투자일임계약자산 </td>
							<td class='th3'  id='td_chr_85'>3.일반</td>
							<td class='th4'  id='td_relname_85'></td>
						</tr>
						<input type='hidden' id='Scode_85' value='3'>
						<input type='hidden' name='code_85' value='018500'><tr id='tr_86' onClick="goDetail('018600',86)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_86' id='chk_86' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0186</td>
							<td class='th2' style='color:#ec4261' id='td_accName_86'>퇴직연금운용자산 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_86'>3.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_86'>퇴직연금충당부채</td>
						</tr>
						<input type='hidden' id='Scode_86' value='3'>
						<input type='hidden' name='code_86' value='018600'><tr id='tr_87' onClick="goDetail('018700',87)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_87' id='chk_87' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0187</td>
							<td class='th2' style='color:#ec4261' id='td_accName_87'>퇴직보험예치금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_87'>3.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_87'>퇴직급여충당부채</td>
						</tr>
						<input type='hidden' id='Scode_87' value='3'>
						<input type='hidden' name='code_87' value='018700'><tr id='tr_88' onClick="goDetail('018800',88)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_88' id='chk_88' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0188</td>
							<td class='th2' style='color:#ec4261' id='td_accName_88'>국민연금전환금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_88'>3.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_88'>퇴직급여충당부채</td>
						</tr>
						<input type='hidden' id='Scode_88' value='3'>
						<input type='hidden' name='code_88' value='018800'><tr id='tr_89' onClick="goDetail('018900',89)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_89' id='chk_89' style='height:12px' value='Y' checked></td>
							<td class='th1' >0189</td>
							<td class='th2'  id='td_accName_89'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_89'></td>
							<td class='th4'  id='td_relname_89'></td>
						</tr>
						<input type='hidden' id='Scode_89' value='3'>
						<input type='hidden' name='code_89' value='018900'><tr id='tr_90' onClick="goDetail('019000',90)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_90' id='chk_90' style='height:12px' value='Y' checked></td>
							<td class='th1' >0190</td>
							<td class='th2'  id='td_accName_90'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_90'></td>
							<td class='th4'  id='td_relname_90'></td>
						</tr>
						<input type='hidden' id='Scode_90' value='3'>
						<input type='hidden' name='code_90' value='019000'><tr id='tr_91' onClick="goDetail('019100',91)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_91' id='chk_91' style='height:12px' value='Y' checked></td>
							<td class='th1' >0191</td>
							<td class='th2'  id='td_accName_91'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_91'></td>
							<td class='th4'  id='td_relname_91'></td>
						</tr>
						<input type='hidden' id='Scode_91' value='3'>
						<input type='hidden' name='code_91' value='019100'><tr id='tr_92' onClick="goDetail('019200',92)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_92' id='chk_92' style='height:12px' value='Y' checked></td>
							<td class='th1' >0192</td>
							<td class='th2'  id='td_accName_92'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_92'></td>
							<td class='th4'  id='td_relname_92'></td>
						</tr>
						<input type='hidden' id='Scode_92' value='3'>
						<input type='hidden' name='code_92' value='019200'><tr id='tr_93' onClick="goDetail('019300',93)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_93' id='chk_93' style='height:12px' value='Y' checked></td>
							<td class='th1' >0193</td>
							<td class='th2'  id='td_accName_93'>출자금 </td>
							<td class='th3'  id='td_chr_93'></td>
							<td class='th4'  id='td_relname_93'></td>
						</tr>
						<input type='hidden' id='Scode_93' value='3'>
						<input type='hidden' name='code_93' value='019300'><tr id='tr_94' onClick="goDetail('019400',94)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_94' id='chk_94' style='height:12px' value='Y' checked></td>
							<td class='th1' >0194</td>
							<td class='th2'  id='td_accName_94'>장기성보험 </td>
							<td class='th3'  id='td_chr_94'>3.일반</td>
							<td class='th4'  id='td_relname_94'></td>
						</tr>
						<input type='hidden' id='Scode_94' value='3'>
						<input type='hidden' name='code_94' value='019400'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_4' id='S_4' style='height:12px' value='Y' onClick="chk_Scode('4')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='4'>유형자산</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_95' onClick="goDetail('019500',95)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_95' id='chk_95' style='height:12px' value='Y' checked></td>
							<td class='th1' >0195</td>
							<td class='th2'  id='td_accName_95'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_95'>1.상각</td>
							<td class='th4'  id='td_relname_95'></td>
						</tr>
						<input type='hidden' id='Scode_95' value='4'>
						<input type='hidden' name='code_95' value='019500'><tr id='tr_96' onClick="goDetail('019600',96)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_96' id='chk_96' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0196</td>
							<td class='th2' style='color:#ec4261' id='td_accName_96'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_96'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_96'>사용자설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_96' value='4'>
						<input type='hidden' name='code_96' value='019600'><tr id='tr_97' onClick="goDetail('019700',97)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_97' id='chk_97' style='height:12px' value='Y' checked></td>
							<td class='th1' >0197</td>
							<td class='th2'  id='td_accName_97'>시설장치 </td>
							<td class='th3'  id='td_chr_97'>1.상각</td>
							<td class='th4'  id='td_relname_97'></td>
						</tr>
						<input type='hidden' id='Scode_97' value='4'>
						<input type='hidden' name='code_97' value='019700'><tr id='tr_98' onClick="goDetail('019800',98)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_98' id='chk_98' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0198</td>
							<td class='th2' style='color:#ec4261' id='td_accName_98'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_98'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_98'>시설장치</td>
						</tr>
						<input type='hidden' id='Scode_98' value='4'>
						<input type='hidden' name='code_98' value='019800'><tr id='tr_99' onClick="goDetail('019900',99)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_99' id='chk_99' style='height:12px' value='Y' checked></td>
							<td class='th1' >0199</td>
							<td class='th2'  id='td_accName_99'>건설용장비 </td>
							<td class='th3'  id='td_chr_99'>1.상각</td>
							<td class='th4'  id='td_relname_99'></td>
						</tr>
						<input type='hidden' id='Scode_99' value='4'>
						<input type='hidden' name='code_99' value='019900'><tr id='tr_100' onClick="goDetail('020000',100)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_100' id='chk_100' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0200</td>
							<td class='th2' style='color:#ec4261' id='td_accName_100'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_100'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_100'>건설용장비</td>
						</tr>
						<input type='hidden' id='Scode_100' value='4'>
						<input type='hidden' name='code_100' value='020000'><tr id='tr_101' onClick="goDetail('020100',101)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_101' id='chk_101' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0201</td>
							<td class='th2' style='color:#ec4261' id='td_accName_101'>토지 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_101'>2.비상각</td>
							<td class='th4' style='color:#ec4261' id='td_relname_101'></td>
						</tr>
						<input type='hidden' id='Scode_101' value='4'>
						<input type='hidden' name='code_101' value='020100'><tr id='tr_102' onClick="goDetail('020200',102)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_102' id='chk_102' style='height:12px' value='Y' checked></td>
							<td class='th1' >0202</td>
							<td class='th2'  id='td_accName_102'>건물 </td>
							<td class='th3'  id='td_chr_102'>1.상각</td>
							<td class='th4'  id='td_relname_102'></td>
						</tr>
						<input type='hidden' id='Scode_102' value='4'>
						<input type='hidden' name='code_102' value='020200'><tr id='tr_103' onClick="goDetail('020300',103)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_103' id='chk_103' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0203</td>
							<td class='th2' style='color:#ec4261' id='td_accName_103'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_103'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_103'>건물</td>
						</tr>
						<input type='hidden' id='Scode_103' value='4'>
						<input type='hidden' name='code_103' value='020300'><tr id='tr_104' onClick="goDetail('020400',104)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_104' id='chk_104' style='height:12px' value='Y' checked></td>
							<td class='th1' >0204</td>
							<td class='th2'  id='td_accName_104'>구축물 </td>
							<td class='th3'  id='td_chr_104'>1.상각</td>
							<td class='th4'  id='td_relname_104'></td>
						</tr>
						<input type='hidden' id='Scode_104' value='4'>
						<input type='hidden' name='code_104' value='020400'><tr id='tr_105' onClick="goDetail('020500',105)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_105' id='chk_105' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0205</td>
							<td class='th2' style='color:#ec4261' id='td_accName_105'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_105'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_105'>구축물</td>
						</tr>
						<input type='hidden' id='Scode_105' value='4'>
						<input type='hidden' name='code_105' value='020500'><tr id='tr_106' onClick="goDetail('020600',106)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_106' id='chk_106' style='height:12px' value='Y' checked></td>
							<td class='th1' >0206</td>
							<td class='th2'  id='td_accName_106'>기계장치 </td>
							<td class='th3'  id='td_chr_106'>1.상각</td>
							<td class='th4'  id='td_relname_106'></td>
						</tr>
						<input type='hidden' id='Scode_106' value='4'>
						<input type='hidden' name='code_106' value='020600'><tr id='tr_107' onClick="goDetail('020700',107)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_107' id='chk_107' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0207</td>
							<td class='th2' style='color:#ec4261' id='td_accName_107'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_107'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_107'>기계장치</td>
						</tr>
						<input type='hidden' id='Scode_107' value='4'>
						<input type='hidden' name='code_107' value='020700'><tr id='tr_108' onClick="goDetail('020800',108)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_108' id='chk_108' style='height:12px' value='Y' checked></td>
							<td class='th1' >0208</td>
							<td class='th2'  id='td_accName_108'>차량운반구 </td>
							<td class='th3'  id='td_chr_108'>1.상각</td>
							<td class='th4'  id='td_relname_108'></td>
						</tr>
						<input type='hidden' id='Scode_108' value='4'>
						<input type='hidden' name='code_108' value='020800'><tr id='tr_109' onClick="goDetail('020900',109)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_109' id='chk_109' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0209</td>
							<td class='th2' style='color:#ec4261' id='td_accName_109'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_109'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_109'>차량운반구</td>
						</tr>
						<input type='hidden' id='Scode_109' value='4'>
						<input type='hidden' name='code_109' value='020900'><tr id='tr_110' onClick="goDetail('021000',110)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_110' id='chk_110' style='height:12px' value='Y' checked></td>
							<td class='th1' >0210</td>
							<td class='th2'  id='td_accName_110'>공구와기구 </td>
							<td class='th3'  id='td_chr_110'>1.상각</td>
							<td class='th4'  id='td_relname_110'></td>
						</tr>
						<input type='hidden' id='Scode_110' value='4'>
						<input type='hidden' name='code_110' value='021000'><tr id='tr_111' onClick="goDetail('021100',111)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_111' id='chk_111' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0211</td>
							<td class='th2' style='color:#ec4261' id='td_accName_111'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_111'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_111'>공구와기구</td>
						</tr>
						<input type='hidden' id='Scode_111' value='4'>
						<input type='hidden' name='code_111' value='021100'><tr id='tr_112' onClick="goDetail('021200',112)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_112' id='chk_112' style='height:12px' value='Y' checked></td>
							<td class='th1' >0212</td>
							<td class='th2'  id='td_accName_112'>집기비품 </td>
							<td class='th3'  id='td_chr_112'>1.상각</td>
							<td class='th4'  id='td_relname_112'></td>
						</tr>
						<input type='hidden' id='Scode_112' value='4'>
						<input type='hidden' name='code_112' value='021200'><tr id='tr_113' onClick="goDetail('021300',113)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_113' id='chk_113' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0213</td>
							<td class='th2' style='color:#ec4261' id='td_accName_113'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_113'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_113'>집기비품</td>
						</tr>
						<input type='hidden' id='Scode_113' value='4'>
						<input type='hidden' name='code_113' value='021300'><tr id='tr_114' onClick="goDetail('021400',114)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_114' id='chk_114' style='height:12px' value='Y' checked></td>
							<td class='th1' >0214</td>
							<td class='th2'  id='td_accName_114'>건설중인자산 </td>
							<td class='th3'  id='td_chr_114'>3.임시</td>
							<td class='th4'  id='td_relname_114'></td>
						</tr>
						<input type='hidden' id='Scode_114' value='4'>
						<input type='hidden' name='code_114' value='021400'><tr id='tr_115' onClick="goDetail('021500',115)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_115' id='chk_115' style='height:12px' value='Y' checked></td>
							<td class='th1' >0215</td>
							<td class='th2'  id='td_accName_115'>미착기계 </td>
							<td class='th3'  id='td_chr_115'>1.상각</td>
							<td class='th4'  id='td_relname_115'></td>
						</tr>
						<input type='hidden' id='Scode_115' value='4'>
						<input type='hidden' name='code_115' value='021500'><tr id='tr_116' onClick="goDetail('021600',116)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_116' id='chk_116' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0216</td>
							<td class='th2' style='color:#ec4261' id='td_accName_116'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_116'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_116'>미착기계</td>
						</tr>
						<input type='hidden' id='Scode_116' value='4'>
						<input type='hidden' name='code_116' value='021600'><tr id='tr_117' onClick="goDetail('021700',117)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_117' id='chk_117' style='height:12px' value='Y' checked></td>
							<td class='th1' >0217</td>
							<td class='th2'  id='td_accName_117'>국고보조금 </td>
							<td class='th3'  id='td_chr_117'>3.임시</td>
							<td class='th4'  id='td_relname_117'></td>
						</tr>
						<input type='hidden' id='Scode_117' value='4'>
						<input type='hidden' name='code_117' value='021700'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_5' id='S_5' style='height:12px' value='Y' onClick="chk_Scode('5')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='5'>무형자산</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_118' onClick="goDetail('021800',118)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_118' id='chk_118' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0218</td>
							<td class='th2' style='color:#ec4261' id='td_accName_118'>영업권 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_118'>1.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_118'></td>
						</tr>
						<input type='hidden' id='Scode_118' value='5'>
						<input type='hidden' name='code_118' value='021800'><tr id='tr_119' onClick="goDetail('021900',119)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_119' id='chk_119' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0219</td>
							<td class='th2' style='color:#ec4261' id='td_accName_119'>특허권 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_119'>1.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_119'></td>
						</tr>
						<input type='hidden' id='Scode_119' value='5'>
						<input type='hidden' name='code_119' value='021900'><tr id='tr_120' onClick="goDetail('022000',120)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_120' id='chk_120' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0220</td>
							<td class='th2' style='color:#ec4261' id='td_accName_120'>상표권 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_120'>1.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_120'></td>
						</tr>
						<input type='hidden' id='Scode_120' value='5'>
						<input type='hidden' name='code_120' value='022000'><tr id='tr_121' onClick="goDetail('022100',121)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_121' id='chk_121' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0221</td>
							<td class='th2' style='color:#ec4261' id='td_accName_121'>실용신안권 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_121'>1.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_121'></td>
						</tr>
						<input type='hidden' id='Scode_121' value='5'>
						<input type='hidden' name='code_121' value='022100'><tr id='tr_122' onClick="goDetail('022200',122)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_122' id='chk_122' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0222</td>
							<td class='th2' style='color:#ec4261' id='td_accName_122'>의장권 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_122'>1.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_122'></td>
						</tr>
						<input type='hidden' id='Scode_122' value='5'>
						<input type='hidden' name='code_122' value='022200'><tr id='tr_123' onClick="goDetail('022300',123)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_123' id='chk_123' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0223</td>
							<td class='th2' style='color:#ec4261' id='td_accName_123'>면허권 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_123'>1.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_123'></td>
						</tr>
						<input type='hidden' id='Scode_123' value='5'>
						<input type='hidden' name='code_123' value='022300'><tr id='tr_124' onClick="goDetail('022400',124)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_124' id='chk_124' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0224</td>
							<td class='th2' style='color:#ec4261' id='td_accName_124'>광업권 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_124'>1.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_124'></td>
						</tr>
						<input type='hidden' id='Scode_124' value='5'>
						<input type='hidden' name='code_124' value='022400'><tr id='tr_125' onClick="goDetail('022500',125)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_125' id='chk_125' style='height:12px' value='Y' checked></td>
							<td class='th1' >0225</td>
							<td class='th2'  id='td_accName_125'>창업비 </td>
							<td class='th3'  id='td_chr_125'>1.일반</td>
							<td class='th4'  id='td_relname_125'></td>
						</tr>
						<input type='hidden' id='Scode_125' value='5'>
						<input type='hidden' name='code_125' value='022500'><tr id='tr_126' onClick="goDetail('022600',126)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_126' id='chk_126' style='height:12px' value='Y' checked></td>
							<td class='th1' >0226</td>
							<td class='th2'  id='td_accName_126'>개발비 </td>
							<td class='th3'  id='td_chr_126'>1.일반</td>
							<td class='th4'  id='td_relname_126'></td>
						</tr>
						<input type='hidden' id='Scode_126' value='5'>
						<input type='hidden' name='code_126' value='022600'><tr id='tr_127' onClick="goDetail('022700',127)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_127' id='chk_127' style='height:12px' value='Y' checked></td>
							<td class='th1' >0227</td>
							<td class='th2'  id='td_accName_127'>소프트웨어 </td>
							<td class='th3'  id='td_chr_127'>1.일반</td>
							<td class='th4'  id='td_relname_127'></td>
						</tr>
						<input type='hidden' id='Scode_127' value='5'>
						<input type='hidden' name='code_127' value='022700'><tr id='tr_128' onClick="goDetail('022800',128)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_128' id='chk_128' style='height:12px' value='Y' checked></td>
							<td class='th1' >0228</td>
							<td class='th2'  id='td_accName_128'>웹사이트원가 </td>
							<td class='th3'  id='td_chr_128'>1.일반</td>
							<td class='th4'  id='td_relname_128'></td>
						</tr>
						<input type='hidden' id='Scode_128' value='5'>
						<input type='hidden' name='code_128' value='022800'><tr id='tr_129' onClick="goDetail('022900',129)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_129' id='chk_129' style='height:12px' value='Y' checked></td>
							<td class='th1' >0229</td>
							<td class='th2'  id='td_accName_129'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_129'></td>
							<td class='th4'  id='td_relname_129'></td>
						</tr>
						<input type='hidden' id='Scode_129' value='5'>
						<input type='hidden' name='code_129' value='022900'><tr id='tr_130' onClick="goDetail('023000',130)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_130' id='chk_130' style='height:12px' value='Y' checked></td>
							<td class='th1' >0230</td>
							<td class='th2'  id='td_accName_130'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_130'></td>
							<td class='th4'  id='td_relname_130'></td>
						</tr>
						<input type='hidden' id='Scode_130' value='5'>
						<input type='hidden' name='code_130' value='023000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_6' id='S_6' style='height:12px' value='Y' onClick="chk_Scode('6')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='6'>기타비유동자산</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_131' onClick="goDetail('023100',131)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_131' id='chk_131' style='height:12px' value='Y' checked></td>
							<td class='th1' >0231</td>
							<td class='th2'  id='td_accName_131'>이연법인세자산 </td>
							<td class='th3'  id='td_chr_131'>3.일반</td>
							<td class='th4'  id='td_relname_131'></td>
						</tr>
						<input type='hidden' id='Scode_131' value='6'>
						<input type='hidden' name='code_131' value='023100'><tr id='tr_132' onClick="goDetail('023200',132)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_132' id='chk_132' style='height:12px' value='Y' checked></td>
							<td class='th1' >0232</td>
							<td class='th2'  id='td_accName_132'>임차보증금 </td>
							<td class='th3'  id='td_chr_132'>3.일반</td>
							<td class='th4'  id='td_relname_132'></td>
						</tr>
						<input type='hidden' id='Scode_132' value='6'>
						<input type='hidden' name='code_132' value='023200'><tr id='tr_133' onClick="goDetail('023300',133)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_133' id='chk_133' style='height:12px' value='Y' checked></td>
							<td class='th1' >0233</td>
							<td class='th2'  id='td_accName_133'>전세권 </td>
							<td class='th3'  id='td_chr_133'>3.일반</td>
							<td class='th4'  id='td_relname_133'></td>
						</tr>
						<input type='hidden' id='Scode_133' value='6'>
						<input type='hidden' name='code_133' value='023300'><tr id='tr_134' onClick="goDetail('023400',134)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_134' id='chk_134' style='height:12px' value='Y' checked></td>
							<td class='th1' >0234</td>
							<td class='th2'  id='td_accName_134'>기타보증금 </td>
							<td class='th3'  id='td_chr_134'>3.일반</td>
							<td class='th4'  id='td_relname_134'></td>
						</tr>
						<input type='hidden' id='Scode_134' value='6'>
						<input type='hidden' name='code_134' value='023400'><tr id='tr_135' onClick="goDetail('023500',135)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_135' id='chk_135' style='height:12px' value='Y' checked></td>
							<td class='th1' >0235</td>
							<td class='th2'  id='td_accName_135'>장기외상매출금 </td>
							<td class='th3'  id='td_chr_135'>3.일반</td>
							<td class='th4'  id='td_relname_135'></td>
						</tr>
						<input type='hidden' id='Scode_135' value='6'>
						<input type='hidden' name='code_135' value='023500'><tr id='tr_136' onClick="goDetail('023600',136)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_136' id='chk_136' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0236</td>
							<td class='th2' style='color:#ec4261' id='td_accName_136'>현재가치할인차금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_136'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_136'>장기외상매출금</td>
						</tr>
						<input type='hidden' id='Scode_136' value='6'>
						<input type='hidden' name='code_136' value='023600'><tr id='tr_137' onClick="goDetail('023700',137)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_137' id='chk_137' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0237</td>
							<td class='th2' style='color:#ec4261' id='td_accName_137'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_137'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_137'>장기외상매출금</td>
						</tr>
						<input type='hidden' id='Scode_137' value='6'>
						<input type='hidden' name='code_137' value='023700'><tr id='tr_138' onClick="goDetail('023800',138)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_138' id='chk_138' style='height:12px' value='Y' checked></td>
							<td class='th1' >0238</td>
							<td class='th2'  id='td_accName_138'>장기받을어음 </td>
							<td class='th3'  id='td_chr_138'>8.받을어음</td>
							<td class='th4'  id='td_relname_138'></td>
						</tr>
						<input type='hidden' id='Scode_138' value='6'>
						<input type='hidden' name='code_138' value='023800'><tr id='tr_139' onClick="goDetail('023900',139)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_139' id='chk_139' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0239</td>
							<td class='th2' style='color:#ec4261' id='td_accName_139'>현재가치할인차금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_139'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_139'>장기받을어음</td>
						</tr>
						<input type='hidden' id='Scode_139' value='6'>
						<input type='hidden' name='code_139' value='023900'><tr id='tr_140' onClick="goDetail('024000',140)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_140' id='chk_140' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0240</td>
							<td class='th2' style='color:#ec4261' id='td_accName_140'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_140'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_140'>장기받을어음</td>
						</tr>
						<input type='hidden' id='Scode_140' value='6'>
						<input type='hidden' name='code_140' value='024000'><tr id='tr_141' onClick="goDetail('024100',141)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_141' id='chk_141' style='height:12px' value='Y' checked></td>
							<td class='th1' >0241</td>
							<td class='th2'  id='td_accName_141'>장기미수금 </td>
							<td class='th3'  id='td_chr_141'>3.일반</td>
							<td class='th4'  id='td_relname_141'></td>
						</tr>
						<input type='hidden' id='Scode_141' value='6'>
						<input type='hidden' name='code_141' value='024100'><tr id='tr_142' onClick="goDetail('024200',142)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_142' id='chk_142' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0242</td>
							<td class='th2' style='color:#ec4261' id='td_accName_142'>현재가치할인차금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_142'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_142'>장기미수금</td>
						</tr>
						<input type='hidden' id='Scode_142' value='6'>
						<input type='hidden' name='code_142' value='024200'><tr id='tr_143' onClick="goDetail('024300',143)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_143' id='chk_143' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0243</td>
							<td class='th2' style='color:#ec4261' id='td_accName_143'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_143'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_143'>장기미수금</td>
						</tr>
						<input type='hidden' id='Scode_143' value='6'>
						<input type='hidden' name='code_143' value='024300'><tr id='tr_144' onClick="goDetail('024400',144)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_144' id='chk_144' style='height:12px' value='Y' checked></td>
							<td class='th1' >0244</td>
							<td class='th2'  id='td_accName_144'>장기선급비용 </td>
							<td class='th3'  id='td_chr_144'>3.일반</td>
							<td class='th4'  id='td_relname_144'></td>
						</tr>
						<input type='hidden' id='Scode_144' value='6'>
						<input type='hidden' name='code_144' value='024400'><tr id='tr_145' onClick="goDetail('024500',145)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_145' id='chk_145' style='height:12px' value='Y' checked></td>
							<td class='th1' >0245</td>
							<td class='th2'  id='td_accName_145'>장기선급금 </td>
							<td class='th3'  id='td_chr_145'>3.일반</td>
							<td class='th4'  id='td_relname_145'></td>
						</tr>
						<input type='hidden' id='Scode_145' value='6'>
						<input type='hidden' name='code_145' value='024500'><tr id='tr_146' onClick="goDetail('024600',146)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_146' id='chk_146' style='height:12px' value='Y' checked></td>
							<td class='th1' >0246</td>
							<td class='th2'  id='td_accName_146'>부도어음과수표 </td>
							<td class='th3'  id='td_chr_146'>3.일반</td>
							<td class='th4'  id='td_relname_146'></td>
						</tr>
						<input type='hidden' id='Scode_146' value='6'>
						<input type='hidden' name='code_146' value='024600'><tr id='tr_147' onClick="goDetail('024700',147)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_147' id='chk_147' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0247</td>
							<td class='th2' style='color:#ec4261' id='td_accName_147'>대손충당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_147'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_147'>부도어음과수표</td>
						</tr>
						<input type='hidden' id='Scode_147' value='6'>
						<input type='hidden' name='code_147' value='024700'><tr id='tr_148' onClick="goDetail('024800',148)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_148' id='chk_148' style='height:12px' value='Y' checked></td>
							<td class='th1' >0248</td>
							<td class='th2'  id='td_accName_148'>전신전화가입권 </td>
							<td class='th3'  id='td_chr_148'>3.일반</td>
							<td class='th4'  id='td_relname_148'></td>
						</tr>
						<input type='hidden' id='Scode_148' value='6'>
						<input type='hidden' name='code_148' value='024800'><tr id='tr_149' onClick="goDetail('024900',149)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_149' id='chk_149' style='height:12px' value='Y' checked></td>
							<td class='th1' >0249</td>
							<td class='th2'  id='td_accName_149'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_149'></td>
							<td class='th4'  id='td_relname_149'></td>
						</tr>
						<input type='hidden' id='Scode_149' value='6'>
						<input type='hidden' name='code_149' value='024900'><tr id='tr_150' onClick="goDetail('025000',150)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_150' id='chk_150' style='height:12px' value='Y' checked></td>
							<td class='th1' >0250</td>
							<td class='th2'  id='td_accName_150'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_150'></td>
							<td class='th4'  id='td_relname_150'></td>
						</tr>
						<input type='hidden' id='Scode_150' value='6'>
						<input type='hidden' name='code_150' value='025000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_7' id='S_7' style='height:12px' value='Y' onClick="chk_Scode('7')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='7'>유동부채</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_151' onClick="goDetail('025100',151)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_151' id='chk_151' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0251</td>
							<td class='th2' style='color:#ec4261' id='td_accName_151'>외상매입금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_151'>2.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_151'></td>
						</tr>
						<input type='hidden' id='Scode_151' value='7'>
						<input type='hidden' name='code_151' value='025100'><tr id='tr_152' onClick="goDetail('025200',152)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_152' id='chk_152' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0252</td>
							<td class='th2' style='color:#ec4261' id='td_accName_152'>지급어음 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_152'>6.지급어음</td>
							<td class='th4' style='color:#ec4261' id='td_relname_152'></td>
						</tr>
						<input type='hidden' id='Scode_152' value='7'>
						<input type='hidden' name='code_152' value='025200'><tr id='tr_153' onClick="goDetail('025300',153)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_153' id='chk_153' style='height:12px' value='Y' checked></td>
							<td class='th1' >0253</td>
							<td class='th2'  id='td_accName_153'>미지급금 </td>
							<td class='th3'  id='td_chr_153'>2.일반</td>
							<td class='th4'  id='td_relname_153'></td>
						</tr>
						<input type='hidden' id='Scode_153' value='7'>
						<input type='hidden' name='code_153' value='025300'><tr id='tr_154' onClick="goDetail('025400',154)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_154' id='chk_154' style='height:12px' value='Y' checked></td>
							<td class='th1' >0254</td>
							<td class='th2'  id='td_accName_154'>예수금 </td>
							<td class='th3'  id='td_chr_154'>2.일반</td>
							<td class='th4'  id='td_relname_154'></td>
						</tr>
						<input type='hidden' id='Scode_154' value='7'>
						<input type='hidden' name='code_154' value='025400'><tr id='tr_155' onClick="goDetail('025500',155)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_155' id='chk_155' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0255</td>
							<td class='th2' style='color:#ec4261' id='td_accName_155'>부가세예수금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_155'>2.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_155'></td>
						</tr>
						<input type='hidden' id='Scode_155' value='7'>
						<input type='hidden' name='code_155' value='025500'><tr id='tr_156' onClick="goDetail('025600',156)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_156' id='chk_156' style='height:12px' value='Y' checked></td>
							<td class='th1' >0256</td>
							<td class='th2'  id='td_accName_156'>당좌차월 </td>
							<td class='th3'  id='td_chr_156'>1.차입금</td>
							<td class='th4'  id='td_relname_156'></td>
						</tr>
						<input type='hidden' id='Scode_156' value='7'>
						<input type='hidden' name='code_156' value='025600'><tr id='tr_157' onClick="goDetail('025700',157)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_157' id='chk_157' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0257</td>
							<td class='th2' style='color:#ec4261' id='td_accName_157'>가수금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_157'>5.가수금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_157'></td>
						</tr>
						<input type='hidden' id='Scode_157' value='7'>
						<input type='hidden' name='code_157' value='025700'><tr id='tr_158' onClick="goDetail('025800',158)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_158' id='chk_158' style='height:12px' value='Y' checked></td>
							<td class='th1' >0258</td>
							<td class='th2'  id='td_accName_158'>예수보증금 </td>
							<td class='th3'  id='td_chr_158'>2.일반</td>
							<td class='th4'  id='td_relname_158'></td>
						</tr>
						<input type='hidden' id='Scode_158' value='7'>
						<input type='hidden' name='code_158' value='025800'><tr id='tr_159' onClick="goDetail('025900',159)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_159' id='chk_159' style='height:12px' value='Y' checked></td>
							<td class='th1' >0259</td>
							<td class='th2'  id='td_accName_159'>선수금 </td>
							<td class='th3'  id='td_chr_159'>2.일반</td>
							<td class='th4'  id='td_relname_159'></td>
						</tr>
						<input type='hidden' id='Scode_159' value='7'>
						<input type='hidden' name='code_159' value='025900'><tr id='tr_160' onClick="goDetail('026000',160)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_160' id='chk_160' style='height:12px' value='Y' checked></td>
							<td class='th1' >0260</td>
							<td class='th2'  id='td_accName_160'>단기차입금 </td>
							<td class='th3'  id='td_chr_160'>1.차입금</td>
							<td class='th4'  id='td_relname_160'></td>
						</tr>
						<input type='hidden' id='Scode_160' value='7'>
						<input type='hidden' name='code_160' value='026000'><tr id='tr_161' onClick="goDetail('026100',161)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_161' id='chk_161' style='height:12px' value='Y' checked></td>
							<td class='th1' >0261</td>
							<td class='th2'  id='td_accName_161'>미지급세금 </td>
							<td class='th3'  id='td_chr_161'>2.일반</td>
							<td class='th4'  id='td_relname_161'></td>
						</tr>
						<input type='hidden' id='Scode_161' value='7'>
						<input type='hidden' name='code_161' value='026100'><tr id='tr_162' onClick="goDetail('026200',162)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_162' id='chk_162' style='height:12px' value='Y' checked></td>
							<td class='th1' >0262</td>
							<td class='th2'  id='td_accName_162'>미지급비용 </td>
							<td class='th3'  id='td_chr_162'>2.일반</td>
							<td class='th4'  id='td_relname_162'></td>
						</tr>
						<input type='hidden' id='Scode_162' value='7'>
						<input type='hidden' name='code_162' value='026200'><tr id='tr_163' onClick="goDetail('026300',163)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_163' id='chk_163' style='height:12px' value='Y' checked></td>
							<td class='th1' >0263</td>
							<td class='th2'  id='td_accName_163'>선수수익 </td>
							<td class='th3'  id='td_chr_163'>2.일반</td>
							<td class='th4'  id='td_relname_163'></td>
						</tr>
						<input type='hidden' id='Scode_163' value='7'>
						<input type='hidden' name='code_163' value='026300'><tr id='tr_164' onClick="goDetail('026400',164)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_164' id='chk_164' style='height:12px' value='Y' checked></td>
							<td class='th1' >0264</td>
							<td class='th2'  id='td_accName_164'>유동성장기부채 </td>
							<td class='th3'  id='td_chr_164'>1.차입금</td>
							<td class='th4'  id='td_relname_164'></td>
						</tr>
						<input type='hidden' id='Scode_164' value='7'>
						<input type='hidden' name='code_164' value='026400'><tr id='tr_165' onClick="goDetail('026500',165)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_165' id='chk_165' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0265</td>
							<td class='th2' style='color:#ec4261' id='td_accName_165'>미지급배당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_165'>2.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_165'></td>
						</tr>
						<input type='hidden' id='Scode_165' value='7'>
						<input type='hidden' name='code_165' value='026500'><tr id='tr_166' onClick="goDetail('026600',166)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_166' id='chk_166' style='height:12px' value='Y' checked></td>
							<td class='th1' >0266</td>
							<td class='th2'  id='td_accName_166'>지급보증채무 </td>
							<td class='th3'  id='td_chr_166'>2.일반</td>
							<td class='th4'  id='td_relname_166'></td>
						</tr>
						<input type='hidden' id='Scode_166' value='7'>
						<input type='hidden' name='code_166' value='026600'><tr id='tr_167' onClick="goDetail('026700',167)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_167' id='chk_167' style='height:12px' value='Y' checked></td>
							<td class='th1' >0267</td>
							<td class='th2'  id='td_accName_167'>미지급배당금 </td>
							<td class='th3'  id='td_chr_167'>2.일반</td>
							<td class='th4'  id='td_relname_167'></td>
						</tr>
						<input type='hidden' id='Scode_167' value='7'>
						<input type='hidden' name='code_167' value='026700'><tr id='tr_168' onClick="goDetail('026800',168)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_168' id='chk_168' style='height:12px' value='Y' checked></td>
							<td class='th1' >0268</td>
							<td class='th2'  id='td_accName_168'>수입금융 </td>
							<td class='th3'  id='td_chr_168'>2.일반</td>
							<td class='th4'  id='td_relname_168'></td>
						</tr>
						<input type='hidden' id='Scode_168' value='7'>
						<input type='hidden' name='code_168' value='026800'><tr id='tr_169' onClick="goDetail('026900',169)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_169' id='chk_169' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0269</td>
							<td class='th2' style='color:#ec4261' id='td_accName_169'>공사손실충당부채 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_169'>2.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_169'></td>
						</tr>
						<input type='hidden' id='Scode_169' value='7'>
						<input type='hidden' name='code_169' value='026900'><tr id='tr_170' onClick="goDetail('027000',170)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_170' id='chk_170' style='height:12px' value='Y' checked></td>
							<td class='th1' >0270</td>
							<td class='th2'  id='td_accName_170'>하자보수충당부채 </td>
							<td class='th3'  id='td_chr_170'>2.일반</td>
							<td class='th4'  id='td_relname_170'></td>
						</tr>
						<input type='hidden' id='Scode_170' value='7'>
						<input type='hidden' name='code_170' value='027000'><tr id='tr_171' onClick="goDetail('027100',171)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_171' id='chk_171' style='height:12px' value='Y' checked></td>
							<td class='th1' >0271</td>
							<td class='th2'  id='td_accName_171'>공사선수금 </td>
							<td class='th3'  id='td_chr_171'>2.일반</td>
							<td class='th4'  id='td_relname_171'></td>
						</tr>
						<input type='hidden' id='Scode_171' value='7'>
						<input type='hidden' name='code_171' value='027100'><tr id='tr_172' onClick="goDetail('027200',172)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_172' id='chk_172' style='height:12px' value='Y' checked></td>
							<td class='th1' >0272</td>
							<td class='th2'  id='td_accName_172'>분양선수금 </td>
							<td class='th3'  id='td_chr_172'>2.일반</td>
							<td class='th4'  id='td_relname_172'></td>
						</tr>
						<input type='hidden' id='Scode_172' value='7'>
						<input type='hidden' name='code_172' value='027200'><tr id='tr_173' onClick="goDetail('027300',173)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_173' id='chk_173' style='height:12px' value='Y' checked></td>
							<td class='th1' >0273</td>
							<td class='th2'  id='td_accName_173'>이연법인세부채 </td>
							<td class='th3'  id='td_chr_173'>2.일반</td>
							<td class='th4'  id='td_relname_173'></td>
						</tr>
						<input type='hidden' id='Scode_173' value='7'>
						<input type='hidden' name='code_173' value='027300'><tr id='tr_174' onClick="goDetail('027400',174)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_174' id='chk_174' style='height:12px' value='Y' checked></td>
							<td class='th1' >0274</td>
							<td class='th2'  id='td_accName_174'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_174'></td>
							<td class='th4'  id='td_relname_174'></td>
						</tr>
						<input type='hidden' id='Scode_174' value='7'>
						<input type='hidden' name='code_174' value='027400'><tr id='tr_175' onClick="goDetail('027500',175)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_175' id='chk_175' style='height:12px' value='Y' checked></td>
							<td class='th1' >0275</td>
							<td class='th2'  id='td_accName_175'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_175'></td>
							<td class='th4'  id='td_relname_175'></td>
						</tr>
						<input type='hidden' id='Scode_175' value='7'>
						<input type='hidden' name='code_175' value='027500'><tr id='tr_176' onClick="goDetail('027600',176)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_176' id='chk_176' style='height:12px' value='Y' checked></td>
							<td class='th1' >0276</td>
							<td class='th2'  id='td_accName_176'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_176'></td>
							<td class='th4'  id='td_relname_176'></td>
						</tr>
						<input type='hidden' id='Scode_176' value='7'>
						<input type='hidden' name='code_176' value='027600'><tr id='tr_177' onClick="goDetail('027700',177)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_177' id='chk_177' style='height:12px' value='Y' checked></td>
							<td class='th1' >0277</td>
							<td class='th2'  id='td_accName_177'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_177'></td>
							<td class='th4'  id='td_relname_177'></td>
						</tr>
						<input type='hidden' id='Scode_177' value='7'>
						<input type='hidden' name='code_177' value='027700'><tr id='tr_178' onClick="goDetail('027800',178)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_178' id='chk_178' style='height:12px' value='Y' checked></td>
							<td class='th1' >0278</td>
							<td class='th2'  id='td_accName_178'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_178'></td>
							<td class='th4'  id='td_relname_178'></td>
						</tr>
						<input type='hidden' id='Scode_178' value='7'>
						<input type='hidden' name='code_178' value='027800'><tr id='tr_179' onClick="goDetail('027900',179)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_179' id='chk_179' style='height:12px' value='Y' checked></td>
							<td class='th1' >0279</td>
							<td class='th2'  id='td_accName_179'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_179'></td>
							<td class='th4'  id='td_relname_179'></td>
						</tr>
						<input type='hidden' id='Scode_179' value='7'>
						<input type='hidden' name='code_179' value='027900'><tr id='tr_180' onClick="goDetail('028000',180)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_180' id='chk_180' style='height:12px' value='Y' checked></td>
							<td class='th1' >0280</td>
							<td class='th2'  id='td_accName_180'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_180'></td>
							<td class='th4'  id='td_relname_180'></td>
						</tr>
						<input type='hidden' id='Scode_180' value='7'>
						<input type='hidden' name='code_180' value='028000'><tr id='tr_181' onClick="goDetail('028100',181)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_181' id='chk_181' style='height:12px' value='Y' checked></td>
							<td class='th1' >0281</td>
							<td class='th2'  id='td_accName_181'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_181'></td>
							<td class='th4'  id='td_relname_181'></td>
						</tr>
						<input type='hidden' id='Scode_181' value='7'>
						<input type='hidden' name='code_181' value='028100'><tr id='tr_182' onClick="goDetail('028200',182)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_182' id='chk_182' style='height:12px' value='Y' checked></td>
							<td class='th1' >0282</td>
							<td class='th2'  id='td_accName_182'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_182'></td>
							<td class='th4'  id='td_relname_182'></td>
						</tr>
						<input type='hidden' id='Scode_182' value='7'>
						<input type='hidden' name='code_182' value='028200'><tr id='tr_183' onClick="goDetail('028300',183)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_183' id='chk_183' style='height:12px' value='Y' checked></td>
							<td class='th1' >0283</td>
							<td class='th2'  id='td_accName_183'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_183'></td>
							<td class='th4'  id='td_relname_183'></td>
						</tr>
						<input type='hidden' id='Scode_183' value='7'>
						<input type='hidden' name='code_183' value='028300'><tr id='tr_184' onClick="goDetail('028400',184)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_184' id='chk_184' style='height:12px' value='Y' checked></td>
							<td class='th1' >0284</td>
							<td class='th2'  id='td_accName_184'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_184'></td>
							<td class='th4'  id='td_relname_184'></td>
						</tr>
						<input type='hidden' id='Scode_184' value='7'>
						<input type='hidden' name='code_184' value='028400'><tr id='tr_185' onClick="goDetail('028500',185)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_185' id='chk_185' style='height:12px' value='Y' checked></td>
							<td class='th1' >0285</td>
							<td class='th2'  id='td_accName_185'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_185'></td>
							<td class='th4'  id='td_relname_185'></td>
						</tr>
						<input type='hidden' id='Scode_185' value='7'>
						<input type='hidden' name='code_185' value='028500'><tr id='tr_186' onClick="goDetail('028600',186)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_186' id='chk_186' style='height:12px' value='Y' checked></td>
							<td class='th1' >0286</td>
							<td class='th2'  id='td_accName_186'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_186'></td>
							<td class='th4'  id='td_relname_186'></td>
						</tr>
						<input type='hidden' id='Scode_186' value='7'>
						<input type='hidden' name='code_186' value='028600'><tr id='tr_187' onClick="goDetail('028700',187)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_187' id='chk_187' style='height:12px' value='Y' checked></td>
							<td class='th1' >0287</td>
							<td class='th2'  id='td_accName_187'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_187'></td>
							<td class='th4'  id='td_relname_187'></td>
						</tr>
						<input type='hidden' id='Scode_187' value='7'>
						<input type='hidden' name='code_187' value='028700'><tr id='tr_188' onClick="goDetail('028800',188)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_188' id='chk_188' style='height:12px' value='Y' checked></td>
							<td class='th1' >0288</td>
							<td class='th2'  id='td_accName_188'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_188'></td>
							<td class='th4'  id='td_relname_188'></td>
						</tr>
						<input type='hidden' id='Scode_188' value='7'>
						<input type='hidden' name='code_188' value='028800'><tr id='tr_189' onClick="goDetail('028900',189)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_189' id='chk_189' style='height:12px' value='Y' checked></td>
							<td class='th1' >0289</td>
							<td class='th2'  id='td_accName_189'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_189'>2.일반</td>
							<td class='th4'  id='td_relname_189'></td>
						</tr>
						<input type='hidden' id='Scode_189' value='7'>
						<input type='hidden' name='code_189' value='028900'><tr id='tr_190' onClick="goDetail('029000',190)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_190' id='chk_190' style='height:12px' value='Y' checked></td>
							<td class='th1' >0290</td>
							<td class='th2'  id='td_accName_190'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_190'>2.일반</td>
							<td class='th4'  id='td_relname_190'></td>
						</tr>
						<input type='hidden' id='Scode_190' value='7'>
						<input type='hidden' name='code_190' value='029000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_8' id='S_8' style='height:12px' value='Y' onClick="chk_Scode('8')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='8'>비유동부채</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_191' onClick="goDetail('029100',191)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_191' id='chk_191' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0291</td>
							<td class='th2' style='color:#ec4261' id='td_accName_191'>사채 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_191'>6.사채차입금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_191'></td>
						</tr>
						<input type='hidden' id='Scode_191' value='8'>
						<input type='hidden' name='code_191' value='029100'><tr id='tr_192' onClick="goDetail('029200',192)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_192' id='chk_192' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0292</td>
							<td class='th2' style='color:#ec4261' id='td_accName_192'>사채할인발행차금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_192'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_192'>사채</td>
						</tr>
						<input type='hidden' id='Scode_192' value='8'>
						<input type='hidden' name='code_192' value='029200'><tr id='tr_193' onClick="goDetail('029300',193)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_193' id='chk_193' style='height:12px' value='Y' checked></td>
							<td class='th1' >0293</td>
							<td class='th2'  id='td_accName_193'>장기차입금 </td>
							<td class='th3'  id='td_chr_193'>2.차입금</td>
							<td class='th4'  id='td_relname_193'></td>
						</tr>
						<input type='hidden' id='Scode_193' value='8'>
						<input type='hidden' name='code_193' value='029300'><tr id='tr_194' onClick="goDetail('029400',194)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_194' id='chk_194' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0294</td>
							<td class='th2' style='color:#ec4261' id='td_accName_194'>임대보증금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_194'>3.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_194'></td>
						</tr>
						<input type='hidden' id='Scode_194' value='8'>
						<input type='hidden' name='code_194' value='029400'><tr id='tr_195' onClick="goDetail('029500',195)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_195' id='chk_195' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0295</td>
							<td class='th2' style='color:#ec4261' id='td_accName_195'>퇴직급여충당부채 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_195'>5.충당금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_195'></td>
						</tr>
						<input type='hidden' id='Scode_195' value='8'>
						<input type='hidden' name='code_195' value='029500'><tr id='tr_196' onClick="goDetail('029600',196)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_196' id='chk_196' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0296</td>
							<td class='th2' style='color:#ec4261' id='td_accName_196'>퇴직보험충당부채 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_196'>5.충당금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_196'></td>
						</tr>
						<input type='hidden' id='Scode_196' value='8'>
						<input type='hidden' name='code_196' value='029600'><tr id='tr_197' onClick="goDetail('029700',197)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_197' id='chk_197' style='height:12px' value='Y' checked></td>
							<td class='th1' >0297</td>
							<td class='th2'  id='td_accName_197'>장기미지급금 </td>
							<td class='th3'  id='td_chr_197'>3.일반</td>
							<td class='th4'  id='td_relname_197'></td>
						</tr>
						<input type='hidden' id='Scode_197' value='8'>
						<input type='hidden' name='code_197' value='029700'><tr id='tr_198' onClick="goDetail('029800',198)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_198' id='chk_198' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0298</td>
							<td class='th2' style='color:#ec4261' id='td_accName_198'>중소기업투자준비금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_198'>1.준비금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_198'></td>
						</tr>
						<input type='hidden' id='Scode_198' value='8'>
						<input type='hidden' name='code_198' value='029800'><tr id='tr_199' onClick="goDetail('029900',199)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_199' id='chk_199' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0299</td>
							<td class='th2' style='color:#ec4261' id='td_accName_199'>연구인력개발준비금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_199'>1.준비금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_199'></td>
						</tr>
						<input type='hidden' id='Scode_199' value='8'>
						<input type='hidden' name='code_199' value='029900'><tr id='tr_200' onClick="goDetail('030000',200)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_200' id='chk_200' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0300</td>
							<td class='th2' style='color:#ec4261' id='td_accName_200'>해외시장개척준비금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_200'>1.준비금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_200'></td>
						</tr>
						<input type='hidden' id='Scode_200' value='8'>
						<input type='hidden' name='code_200' value='030000'><tr id='tr_201' onClick="goDetail('030100',201)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_201' id='chk_201' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0301</td>
							<td class='th2' style='color:#ec4261' id='td_accName_201'>지방이전준비금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_201'>1.준비금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_201'></td>
						</tr>
						<input type='hidden' id='Scode_201' value='8'>
						<input type='hidden' name='code_201' value='030100'><tr id='tr_202' onClick="goDetail('030200',202)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_202' id='chk_202' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0302</td>
							<td class='th2' style='color:#ec4261' id='td_accName_202'>수출손실준비금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_202'>1.준비금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_202'></td>
						</tr>
						<input type='hidden' id='Scode_202' value='8'>
						<input type='hidden' name='code_202' value='030200'><tr id='tr_203' onClick="goDetail('030300',203)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_203' id='chk_203' style='height:12px' value='Y' checked></td>
							<td class='th1' >0303</td>
							<td class='th2'  id='td_accName_203'>임직원등장기차입금 </td>
							<td class='th3'  id='td_chr_203'>2.차입금</td>
							<td class='th4'  id='td_relname_203'></td>
						</tr>
						<input type='hidden' id='Scode_203' value='8'>
						<input type='hidden' name='code_203' value='030300'><tr id='tr_204' onClick="goDetail('030400',204)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_204' id='chk_204' style='height:12px' value='Y' checked></td>
							<td class='th1' >0304</td>
							<td class='th2'  id='td_accName_204'>관계회사장기차입금 </td>
							<td class='th3'  id='td_chr_204'>2.차입금</td>
							<td class='th4'  id='td_relname_204'></td>
						</tr>
						<input type='hidden' id='Scode_204' value='8'>
						<input type='hidden' name='code_204' value='030400'><tr id='tr_205' onClick="goDetail('030500',205)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_205' id='chk_205' style='height:12px' value='Y' checked></td>
							<td class='th1' >0305</td>
							<td class='th2'  id='td_accName_205'>외화장기차입금 </td>
							<td class='th3'  id='td_chr_205'>2.차입금</td>
							<td class='th4'  id='td_relname_205'></td>
						</tr>
						<input type='hidden' id='Scode_205' value='8'>
						<input type='hidden' name='code_205' value='030500'><tr id='tr_206' onClick="goDetail('030600',206)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_206' id='chk_206' style='height:12px' value='Y' checked></td>
							<td class='th1' >0306</td>
							<td class='th2'  id='td_accName_206'>장기공사선수금 </td>
							<td class='th3'  id='td_chr_206'>3.일반</td>
							<td class='th4'  id='td_relname_206'></td>
						</tr>
						<input type='hidden' id='Scode_206' value='8'>
						<input type='hidden' name='code_206' value='030600'><tr id='tr_207' onClick="goDetail('030700',207)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_207' id='chk_207' style='height:12px' value='Y' checked></td>
							<td class='th1' >0307</td>
							<td class='th2'  id='td_accName_207'>장기임대보증금 </td>
							<td class='th3'  id='td_chr_207'>3.일반</td>
							<td class='th4'  id='td_relname_207'></td>
						</tr>
						<input type='hidden' id='Scode_207' value='8'>
						<input type='hidden' name='code_207' value='030700'><tr id='tr_208' onClick="goDetail('030800',208)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_208' id='chk_208' style='height:12px' value='Y' checked></td>
							<td class='th1' >0308</td>
							<td class='th2'  id='td_accName_208'>장기성지급어음 </td>
							<td class='th3'  id='td_chr_208'>8.지급어음</td>
							<td class='th4'  id='td_relname_208'></td>
						</tr>
						<input type='hidden' id='Scode_208' value='8'>
						<input type='hidden' name='code_208' value='030800'><tr id='tr_209' onClick="goDetail('030900',209)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_209' id='chk_209' style='height:12px' value='Y' checked></td>
							<td class='th1' >0309</td>
							<td class='th2'  id='td_accName_209'>환율조정대 </td>
							<td class='th3'  id='td_chr_209'>3.일반</td>
							<td class='th4'  id='td_relname_209'></td>
						</tr>
						<input type='hidden' id='Scode_209' value='8'>
						<input type='hidden' name='code_209' value='030900'><tr id='tr_210' onClick="goDetail('031000',210)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_210' id='chk_210' style='height:12px' value='Y' checked></td>
							<td class='th1' >0310</td>
							<td class='th2'  id='td_accName_210'>이연법인세부채 </td>
							<td class='th3'  id='td_chr_210'>3.일반</td>
							<td class='th4'  id='td_relname_210'></td>
						</tr>
						<input type='hidden' id='Scode_210' value='8'>
						<input type='hidden' name='code_210' value='031000'><tr id='tr_211' onClick="goDetail('031100',211)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_211' id='chk_211' style='height:12px' value='Y' checked></td>
							<td class='th1' >0311</td>
							<td class='th2'  id='td_accName_211'>신주인수권부사채 </td>
							<td class='th3'  id='td_chr_211'>6.사채차입금</td>
							<td class='th4'  id='td_relname_211'></td>
						</tr>
						<input type='hidden' id='Scode_211' value='8'>
						<input type='hidden' name='code_211' value='031100'><tr id='tr_212' onClick="goDetail('031200',212)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_212' id='chk_212' style='height:12px' value='Y' checked></td>
							<td class='th1' >0312</td>
							<td class='th2'  id='td_accName_212'>전환사채 </td>
							<td class='th3'  id='td_chr_212'>6.사채차입금</td>
							<td class='th4'  id='td_relname_212'></td>
						</tr>
						<input type='hidden' id='Scode_212' value='8'>
						<input type='hidden' name='code_212' value='031200'><tr id='tr_213' onClick="goDetail('031300',213)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_213' id='chk_213' style='height:12px' value='Y' checked></td>
							<td class='th1' >0313</td>
							<td class='th2'  id='td_accName_213'>사채할증발행차금 </td>
							<td class='th3'  id='td_chr_213'>7.증가</td>
							<td class='th4'  id='td_relname_213'>사채</td>
						</tr>
						<input type='hidden' id='Scode_213' value='8'>
						<input type='hidden' name='code_213' value='031300'><tr id='tr_214' onClick="goDetail('031400',214)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_214' id='chk_214' style='height:12px' value='Y' checked></td>
							<td class='th1' >0314</td>
							<td class='th2'  id='td_accName_214'>장기제품보증부채 </td>
							<td class='th3'  id='td_chr_214'>5.충당금</td>
							<td class='th4'  id='td_relname_214'></td>
						</tr>
						<input type='hidden' id='Scode_214' value='8'>
						<input type='hidden' name='code_214' value='031400'><tr id='tr_215' onClick="goDetail('031500',215)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_215' id='chk_215' style='height:12px' value='Y' checked></td>
							<td class='th1' >0315</td>
							<td class='th2'  id='td_accName_215'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_215'></td>
							<td class='th4'  id='td_relname_215'></td>
						</tr>
						<input type='hidden' id='Scode_215' value='8'>
						<input type='hidden' name='code_215' value='031500'><tr id='tr_216' onClick="goDetail('031600',216)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_216' id='chk_216' style='height:12px' value='Y' checked></td>
							<td class='th1' >0316</td>
							<td class='th2'  id='td_accName_216'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_216'></td>
							<td class='th4'  id='td_relname_216'></td>
						</tr>
						<input type='hidden' id='Scode_216' value='8'>
						<input type='hidden' name='code_216' value='031600'><tr id='tr_217' onClick="goDetail('031700',217)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_217' id='chk_217' style='height:12px' value='Y' checked></td>
							<td class='th1' >0317</td>
							<td class='th2'  id='td_accName_217'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_217'></td>
							<td class='th4'  id='td_relname_217'></td>
						</tr>
						<input type='hidden' id='Scode_217' value='8'>
						<input type='hidden' name='code_217' value='031700'><tr id='tr_218' onClick="goDetail('031800',218)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_218' id='chk_218' style='height:12px' value='Y' checked></td>
							<td class='th1' >0318</td>
							<td class='th2'  id='td_accName_218'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_218'></td>
							<td class='th4'  id='td_relname_218'></td>
						</tr>
						<input type='hidden' id='Scode_218' value='8'>
						<input type='hidden' name='code_218' value='031800'><tr id='tr_219' onClick="goDetail('031900',219)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_219' id='chk_219' style='height:12px' value='Y' checked></td>
							<td class='th1' >0319</td>
							<td class='th2'  id='td_accName_219'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_219'></td>
							<td class='th4'  id='td_relname_219'></td>
						</tr>
						<input type='hidden' id='Scode_219' value='8'>
						<input type='hidden' name='code_219' value='031900'><tr id='tr_220' onClick="goDetail('032000',220)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_220' id='chk_220' style='height:12px' value='Y' checked></td>
							<td class='th1' >0320</td>
							<td class='th2'  id='td_accName_220'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_220'></td>
							<td class='th4'  id='td_relname_220'></td>
						</tr>
						<input type='hidden' id='Scode_220' value='8'>
						<input type='hidden' name='code_220' value='032000'><tr id='tr_221' onClick="goDetail('032100',221)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_221' id='chk_221' style='height:12px' value='Y' checked></td>
							<td class='th1' >0321</td>
							<td class='th2'  id='td_accName_221'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_221'></td>
							<td class='th4'  id='td_relname_221'></td>
						</tr>
						<input type='hidden' id='Scode_221' value='8'>
						<input type='hidden' name='code_221' value='032100'><tr id='tr_222' onClick="goDetail('032200',222)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_222' id='chk_222' style='height:12px' value='Y' checked></td>
							<td class='th1' >0322</td>
							<td class='th2'  id='td_accName_222'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_222'></td>
							<td class='th4'  id='td_relname_222'></td>
						</tr>
						<input type='hidden' id='Scode_222' value='8'>
						<input type='hidden' name='code_222' value='032200'><tr id='tr_223' onClick="goDetail('032300',223)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_223' id='chk_223' style='height:12px' value='Y' checked></td>
							<td class='th1' >0323</td>
							<td class='th2'  id='td_accName_223'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_223'></td>
							<td class='th4'  id='td_relname_223'></td>
						</tr>
						<input type='hidden' id='Scode_223' value='8'>
						<input type='hidden' name='code_223' value='032300'><tr id='tr_224' onClick="goDetail('032400',224)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_224' id='chk_224' style='height:12px' value='Y' checked></td>
							<td class='th1' >0324</td>
							<td class='th2'  id='td_accName_224'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_224'></td>
							<td class='th4'  id='td_relname_224'></td>
						</tr>
						<input type='hidden' id='Scode_224' value='8'>
						<input type='hidden' name='code_224' value='032400'><tr id='tr_225' onClick="goDetail('032500',225)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_225' id='chk_225' style='height:12px' value='Y' checked></td>
							<td class='th1' >0325</td>
							<td class='th2'  id='td_accName_225'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_225'></td>
							<td class='th4'  id='td_relname_225'></td>
						</tr>
						<input type='hidden' id='Scode_225' value='8'>
						<input type='hidden' name='code_225' value='032500'><tr id='tr_226' onClick="goDetail('032600',226)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_226' id='chk_226' style='height:12px' value='Y' checked></td>
							<td class='th1' >0326</td>
							<td class='th2'  id='td_accName_226'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_226'></td>
							<td class='th4'  id='td_relname_226'></td>
						</tr>
						<input type='hidden' id='Scode_226' value='8'>
						<input type='hidden' name='code_226' value='032600'><tr id='tr_227' onClick="goDetail('032700',227)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_227' id='chk_227' style='height:12px' value='Y' checked></td>
							<td class='th1' >0327</td>
							<td class='th2'  id='td_accName_227'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_227'></td>
							<td class='th4'  id='td_relname_227'></td>
						</tr>
						<input type='hidden' id='Scode_227' value='8'>
						<input type='hidden' name='code_227' value='032700'><tr id='tr_228' onClick="goDetail('032800',228)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_228' id='chk_228' style='height:12px' value='Y' checked></td>
							<td class='th1' >0328</td>
							<td class='th2'  id='td_accName_228'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_228'></td>
							<td class='th4'  id='td_relname_228'></td>
						</tr>
						<input type='hidden' id='Scode_228' value='8'>
						<input type='hidden' name='code_228' value='032800'><tr id='tr_229' onClick="goDetail('032900',229)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_229' id='chk_229' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0329</td>
							<td class='th2' style='color:#ec4261' id='td_accName_229'>퇴직연금충당부채 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_229'>5.충당금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_229'></td>
						</tr>
						<input type='hidden' id='Scode_229' value='8'>
						<input type='hidden' name='code_229' value='032900'><tr id='tr_230' onClick="goDetail('033000',230)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_230' id='chk_230' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0330</td>
							<td class='th2' style='color:#ec4261' id='td_accName_230'>퇴직연금미지급금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_230'>5.충당금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_230'></td>
						</tr>
						<input type='hidden' id='Scode_230' value='8'>
						<input type='hidden' name='code_230' value='033000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_9' id='S_9' style='height:12px' value='Y' onClick="chk_Scode('9')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='9'>자본금</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_231' onClick="goDetail('033100',231)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_231' id='chk_231' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0331</td>
							<td class='th2' style='color:#ec4261' id='td_accName_231'>자본금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_231'></td>
							<td class='th4' style='color:#ec4261' id='td_relname_231'></td>
						</tr>
						<input type='hidden' id='Scode_231' value='9'>
						<input type='hidden' name='code_231' value='033100'><tr id='tr_232' onClick="goDetail('033200',232)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_232' id='chk_232' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0332</td>
							<td class='th2' style='color:#ec4261' id='td_accName_232'>우선주자본금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_232'></td>
							<td class='th4' style='color:#ec4261' id='td_relname_232'></td>
						</tr>
						<input type='hidden' id='Scode_232' value='9'>
						<input type='hidden' name='code_232' value='033200'><tr id='tr_233' onClick="goDetail('033300',233)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_233' id='chk_233' style='height:12px' value='Y' checked></td>
							<td class='th1' >0333</td>
							<td class='th2'  id='td_accName_233'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_233'>1.자본금</td>
							<td class='th4'  id='td_relname_233'></td>
						</tr>
						<input type='hidden' id='Scode_233' value='9'>
						<input type='hidden' name='code_233' value='033300'><tr id='tr_234' onClick="goDetail('033400',234)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_234' id='chk_234' style='height:12px' value='Y' checked></td>
							<td class='th1' >0334</td>
							<td class='th2'  id='td_accName_234'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_234'></td>
							<td class='th4'  id='td_relname_234'></td>
						</tr>
						<input type='hidden' id='Scode_234' value='9'>
						<input type='hidden' name='code_234' value='033400'><tr id='tr_235' onClick="goDetail('033500',235)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_235' id='chk_235' style='height:12px' value='Y' checked></td>
							<td class='th1' >0335</td>
							<td class='th2'  id='td_accName_235'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_235'></td>
							<td class='th4'  id='td_relname_235'></td>
						</tr>
						<input type='hidden' id='Scode_235' value='9'>
						<input type='hidden' name='code_235' value='033500'><tr id='tr_236' onClick="goDetail('033600',236)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_236' id='chk_236' style='height:12px' value='Y' checked></td>
							<td class='th1' >0336</td>
							<td class='th2'  id='td_accName_236'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_236'></td>
							<td class='th4'  id='td_relname_236'></td>
						</tr>
						<input type='hidden' id='Scode_236' value='9'>
						<input type='hidden' name='code_236' value='033600'><tr id='tr_237' onClick="goDetail('033700',237)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_237' id='chk_237' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0337</td>
							<td class='th2' style='color:#ec4261' id='td_accName_237'>출자금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_237'></td>
							<td class='th4' style='color:#ec4261' id='td_relname_237'></td>
						</tr>
						<input type='hidden' id='Scode_237' value='9'>
						<input type='hidden' name='code_237' value='033700'><tr id='tr_238' onClick="goDetail('033800',238)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_238' id='chk_238' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0338</td>
							<td class='th2' style='color:#ec4261' id='td_accName_238'>인출금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_238'></td>
							<td class='th4' style='color:#ec4261' id='td_relname_238'></td>
						</tr>
						<input type='hidden' id='Scode_238' value='9'>
						<input type='hidden' name='code_238' value='033800'><tr id='tr_239' onClick="goDetail('033900',239)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_239' id='chk_239' style='height:12px' value='Y' checked></td>
							<td class='th1' >0339</td>
							<td class='th2'  id='td_accName_239'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_239'></td>
							<td class='th4'  id='td_relname_239'></td>
						</tr>
						<input type='hidden' id='Scode_239' value='9'>
						<input type='hidden' name='code_239' value='033900'><tr id='tr_240' onClick="goDetail('034000',240)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_240' id='chk_240' style='height:12px' value='Y' checked></td>
							<td class='th1' >0340</td>
							<td class='th2'  id='td_accName_240'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_240'></td>
							<td class='th4'  id='td_relname_240'></td>
						</tr>
						<input type='hidden' id='Scode_240' value='9'>
						<input type='hidden' name='code_240' value='034000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_10' id='S_10' style='height:12px' value='Y' onClick="chk_Scode('10')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='10'>자본잉여금</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_241' onClick="goDetail('034100',241)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_241' id='chk_241' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0341</td>
							<td class='th2' style='color:#ec4261' id='td_accName_241'>주식발행초과금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_241'></td>
							<td class='th4' style='color:#ec4261' id='td_relname_241'></td>
						</tr>
						<input type='hidden' id='Scode_241' value='10'>
						<input type='hidden' name='code_241' value='034100'><tr id='tr_242' onClick="goDetail('034200',242)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_242' id='chk_242' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0342</td>
							<td class='th2' style='color:#ec4261' id='td_accName_242'>감자차익 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_242'></td>
							<td class='th4' style='color:#ec4261' id='td_relname_242'></td>
						</tr>
						<input type='hidden' id='Scode_242' value='10'>
						<input type='hidden' name='code_242' value='034200'><tr id='tr_243' onClick="goDetail('034300',243)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_243' id='chk_243' style='height:12px' value='Y' checked></td>
							<td class='th1' >0343</td>
							<td class='th2'  id='td_accName_243'>자기주식처분이익 </td>
							<td class='th3'  id='td_chr_243'>1.자본잉여금</td>
							<td class='th4'  id='td_relname_243'></td>
						</tr>
						<input type='hidden' id='Scode_243' value='10'>
						<input type='hidden' name='code_243' value='034300'><tr id='tr_244' onClick="goDetail('034400',244)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_244' id='chk_244' style='height:12px' value='Y' checked></td>
							<td class='th1' >0344</td>
							<td class='th2'  id='td_accName_244'>전환권대가 </td>
							<td class='th3'  id='td_chr_244'>1.자본잉여금</td>
							<td class='th4'  id='td_relname_244'></td>
						</tr>
						<input type='hidden' id='Scode_244' value='10'>
						<input type='hidden' name='code_244' value='034400'><tr id='tr_245' onClick="goDetail('034500',245)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_245' id='chk_245' style='height:12px' value='Y' checked></td>
							<td class='th1' >0345</td>
							<td class='th2'  id='td_accName_245'>신주인수권대가 </td>
							<td class='th3'  id='td_chr_245'>1.자본잉여금</td>
							<td class='th4'  id='td_relname_245'></td>
						</tr>
						<input type='hidden' id='Scode_245' value='10'>
						<input type='hidden' name='code_245' value='034500'><tr id='tr_246' onClick="goDetail('034600',246)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_246' id='chk_246' style='height:12px' value='Y' checked></td>
							<td class='th1' >0346</td>
							<td class='th2'  id='td_accName_246'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_246'></td>
							<td class='th4'  id='td_relname_246'></td>
						</tr>
						<input type='hidden' id='Scode_246' value='10'>
						<input type='hidden' name='code_246' value='034600'><tr id='tr_247' onClick="goDetail('034700',247)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_247' id='chk_247' style='height:12px' value='Y' checked></td>
							<td class='th1' >0347</td>
							<td class='th2'  id='td_accName_247'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_247'></td>
							<td class='th4'  id='td_relname_247'></td>
						</tr>
						<input type='hidden' id='Scode_247' value='10'>
						<input type='hidden' name='code_247' value='034700'><tr id='tr_248' onClick="goDetail('034800',248)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_248' id='chk_248' style='height:12px' value='Y' checked></td>
							<td class='th1' >0348</td>
							<td class='th2'  id='td_accName_248'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_248'></td>
							<td class='th4'  id='td_relname_248'></td>
						</tr>
						<input type='hidden' id='Scode_248' value='10'>
						<input type='hidden' name='code_248' value='034800'><tr id='tr_249' onClick="goDetail('034900',249)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_249' id='chk_249' style='height:12px' value='Y' checked></td>
							<td class='th1' >0349</td>
							<td class='th2'  id='td_accName_249'>기타자본잉여금 </td>
							<td class='th3'  id='td_chr_249'>1.자본잉여금</td>
							<td class='th4'  id='td_relname_249'></td>
						</tr>
						<input type='hidden' id='Scode_249' value='10'>
						<input type='hidden' name='code_249' value='034900'><tr id='tr_250' onClick="goDetail('035000',250)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_250' id='chk_250' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0350</td>
							<td class='th2' style='color:#ec4261' id='td_accName_250'>재평가적립금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_250'></td>
							<td class='th4' style='color:#ec4261' id='td_relname_250'></td>
						</tr>
						<input type='hidden' id='Scode_250' value='10'>
						<input type='hidden' name='code_250' value='035000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_11' id='S_11' style='height:12px' value='Y' onClick="chk_Scode('11')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='11'>이익잉여금</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_251' onClick="goDetail('035100',251)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_251' id='chk_251' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0351</td>
							<td class='th2' style='color:#ec4261' id='td_accName_251'>이익준비금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_251'>1.법정적립금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_251'></td>
						</tr>
						<input type='hidden' id='Scode_251' value='11'>
						<input type='hidden' name='code_251' value='035100'><tr id='tr_252' onClick="goDetail('035200',252)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_252' id='chk_252' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0352</td>
							<td class='th2' style='color:#ec4261' id='td_accName_252'>기업합리화적립금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_252'>1.법정적립금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_252'></td>
						</tr>
						<input type='hidden' id='Scode_252' value='11'>
						<input type='hidden' name='code_252' value='035200'><tr id='tr_253' onClick="goDetail('035300',253)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_253' id='chk_253' style='height:12px' value='Y' checked></td>
							<td class='th1' >0353</td>
							<td class='th2'  id='td_accName_253'>제준비금 </td>
							<td class='th3'  id='td_chr_253'>1.법정적립금</td>
							<td class='th4'  id='td_relname_253'></td>
						</tr>
						<input type='hidden' id='Scode_253' value='11'>
						<input type='hidden' name='code_253' value='035300'><tr id='tr_254' onClick="goDetail('035400',254)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_254' id='chk_254' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0354</td>
							<td class='th2' style='color:#ec4261' id='td_accName_254'>재무구조개선적립금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_254'>1.법정적립금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_254'></td>
						</tr>
						<input type='hidden' id='Scode_254' value='11'>
						<input type='hidden' name='code_254' value='035400'><tr id='tr_255' onClick="goDetail('035500',255)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_255' id='chk_255' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0355</td>
							<td class='th2' style='color:#ec4261' id='td_accName_255'>임의적립금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_255'>2.임의적립금</td>
							<td class='th4' style='color:#ec4261' id='td_relname_255'></td>
						</tr>
						<input type='hidden' id='Scode_255' value='11'>
						<input type='hidden' name='code_255' value='035500'><tr id='tr_256' onClick="goDetail('035600',256)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_256' id='chk_256' style='height:12px' value='Y' checked></td>
							<td class='th1' >0356</td>
							<td class='th2'  id='td_accName_256'>사업확장적립금 </td>
							<td class='th3'  id='td_chr_256'>2.임의적립금</td>
							<td class='th4'  id='td_relname_256'></td>
						</tr>
						<input type='hidden' id='Scode_256' value='11'>
						<input type='hidden' name='code_256' value='035600'><tr id='tr_257' onClick="goDetail('035700',257)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_257' id='chk_257' style='height:12px' value='Y' checked></td>
							<td class='th1' >0357</td>
							<td class='th2'  id='td_accName_257'>감채적립금 </td>
							<td class='th3'  id='td_chr_257'>2.임의적립금</td>
							<td class='th4'  id='td_relname_257'></td>
						</tr>
						<input type='hidden' id='Scode_257' value='11'>
						<input type='hidden' name='code_257' value='035700'><tr id='tr_258' onClick="goDetail('035800',258)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_258' id='chk_258' style='height:12px' value='Y' checked></td>
							<td class='th1' >0358</td>
							<td class='th2'  id='td_accName_258'>배당평균적립금 </td>
							<td class='th3'  id='td_chr_258'>2.임의적립금</td>
							<td class='th4'  id='td_relname_258'></td>
						</tr>
						<input type='hidden' id='Scode_258' value='11'>
						<input type='hidden' name='code_258' value='035800'><tr id='tr_259' onClick="goDetail('035900',259)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_259' id='chk_259' style='height:12px' value='Y' checked></td>
							<td class='th1' >0359</td>
							<td class='th2'  id='td_accName_259'>주식할인발행차금상각 </td>
							<td class='th3'  id='td_chr_259'>3.미처분이익</td>
							<td class='th4'  id='td_relname_259'></td>
						</tr>
						<input type='hidden' id='Scode_259' value='11'>
						<input type='hidden' name='code_259' value='035900'><tr id='tr_260' onClick="goDetail('036000',260)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_260' id='chk_260' style='height:12px' value='Y' checked></td>
							<td class='th1' >0360</td>
							<td class='th2'  id='td_accName_260'>별도적립금 </td>
							<td class='th3'  id='td_chr_260'>3.미처분이익</td>
							<td class='th4'  id='td_relname_260'></td>
						</tr>
						<input type='hidden' id='Scode_260' value='11'>
						<input type='hidden' name='code_260' value='036000'><tr id='tr_261' onClick="goDetail('036100',261)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_261' id='chk_261' style='height:12px' value='Y' checked></td>
							<td class='th1' >0361</td>
							<td class='th2'  id='td_accName_261'>상환주식의상환액 </td>
							<td class='th3'  id='td_chr_261'>3.미처분이익</td>
							<td class='th4'  id='td_relname_261'></td>
						</tr>
						<input type='hidden' id='Scode_261' value='11'>
						<input type='hidden' name='code_261' value='036100'><tr id='tr_262' onClick="goDetail('036200',262)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_262' id='chk_262' style='height:12px' value='Y' checked></td>
							<td class='th1' >0362</td>
							<td class='th2'  id='td_accName_262'>자기주식처분손잔액 </td>
							<td class='th3'  id='td_chr_262'>3.미처분이익</td>
							<td class='th4'  id='td_relname_262'></td>
						</tr>
						<input type='hidden' id='Scode_262' value='11'>
						<input type='hidden' name='code_262' value='036200'><tr id='tr_263' onClick="goDetail('036300',263)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_263' id='chk_263' style='height:12px' value='Y' checked></td>
							<td class='th1' >0363</td>
							<td class='th2'  id='td_accName_263'>중소기업투자준비금 </td>
							<td class='th3'  id='td_chr_263'>2.임의적립금</td>
							<td class='th4'  id='td_relname_263'></td>
						</tr>
						<input type='hidden' id='Scode_263' value='11'>
						<input type='hidden' name='code_263' value='036300'><tr id='tr_264' onClick="goDetail('036400',264)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_264' id='chk_264' style='height:12px' value='Y' checked></td>
							<td class='th1' >0364</td>
							<td class='th2'  id='td_accName_264'>연구인력개발준비금 </td>
							<td class='th3'  id='td_chr_264'>2.임의적립금</td>
							<td class='th4'  id='td_relname_264'></td>
						</tr>
						<input type='hidden' id='Scode_264' value='11'>
						<input type='hidden' name='code_264' value='036400'><tr id='tr_265' onClick="goDetail('036500',265)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_265' id='chk_265' style='height:12px' value='Y' checked></td>
							<td class='th1' >0365</td>
							<td class='th2'  id='td_accName_265'>해외시장개척준비금 </td>
							<td class='th3'  id='td_chr_265'>2.임의적립금</td>
							<td class='th4'  id='td_relname_265'></td>
						</tr>
						<input type='hidden' id='Scode_265' value='11'>
						<input type='hidden' name='code_265' value='036500'><tr id='tr_266' onClick="goDetail('036600',266)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_266' id='chk_266' style='height:12px' value='Y' checked></td>
							<td class='th1' >0366</td>
							<td class='th2'  id='td_accName_266'>지방이전준비금 </td>
							<td class='th3'  id='td_chr_266'>2.임의적립금</td>
							<td class='th4'  id='td_relname_266'></td>
						</tr>
						<input type='hidden' id='Scode_266' value='11'>
						<input type='hidden' name='code_266' value='036600'><tr id='tr_267' onClick="goDetail('036700',267)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_267' id='chk_267' style='height:12px' value='Y' checked></td>
							<td class='th1' >0367</td>
							<td class='th2'  id='td_accName_267'>수출손실준비금 </td>
							<td class='th3'  id='td_chr_267'>2.임의적립금</td>
							<td class='th4'  id='td_relname_267'></td>
						</tr>
						<input type='hidden' id='Scode_267' value='11'>
						<input type='hidden' name='code_267' value='036700'><tr id='tr_268' onClick="goDetail('036800',268)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_268' id='chk_268' style='height:12px' value='Y' checked></td>
							<td class='th1' >0368</td>
							<td class='th2'  id='td_accName_268'>기타임의적립금 </td>
							<td class='th3'  id='td_chr_268'>2.임의적립금</td>
							<td class='th4'  id='td_relname_268'></td>
						</tr>
						<input type='hidden' id='Scode_268' value='11'>
						<input type='hidden' name='code_268' value='036800'><tr id='tr_269' onClick="goDetail('036900',269)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_269' id='chk_269' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0369</td>
							<td class='th2' style='color:#ec4261' id='td_accName_269'>회계변경누적효과 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_269'>3.미처분이익</td>
							<td class='th4' style='color:#ec4261' id='td_relname_269'></td>
						</tr>
						<input type='hidden' id='Scode_269' value='11'>
						<input type='hidden' name='code_269' value='036900'><tr id='tr_270' onClick="goDetail('037000',270)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_270' id='chk_270' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0370</td>
							<td class='th2' style='color:#ec4261' id='td_accName_270'>전기오류수정이익 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_270'>3.미처분이익</td>
							<td class='th4' style='color:#ec4261' id='td_relname_270'></td>
						</tr>
						<input type='hidden' id='Scode_270' value='11'>
						<input type='hidden' name='code_270' value='037000'><tr id='tr_271' onClick="goDetail('037100',271)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_271' id='chk_271' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0371</td>
							<td class='th2' style='color:#ec4261' id='td_accName_271'>전기오류수정손실 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_271'>3.미처분이익</td>
							<td class='th4' style='color:#ec4261' id='td_relname_271'></td>
						</tr>
						<input type='hidden' id='Scode_271' value='11'>
						<input type='hidden' name='code_271' value='037100'><tr id='tr_272' onClick="goDetail('037200',272)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_272' id='chk_272' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0372</td>
							<td class='th2' style='color:#ec4261' id='td_accName_272'>중간배당액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_272'>3.미처분이익</td>
							<td class='th4' style='color:#ec4261' id='td_relname_272'></td>
						</tr>
						<input type='hidden' id='Scode_272' value='11'>
						<input type='hidden' name='code_272' value='037200'><tr id='tr_273' onClick="goDetail('037300',273)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_273' id='chk_273' style='height:12px' value='Y' checked></td>
							<td class='th1' >0373</td>
							<td class='th2'  id='td_accName_273'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_273'></td>
							<td class='th4'  id='td_relname_273'></td>
						</tr>
						<input type='hidden' id='Scode_273' value='11'>
						<input type='hidden' name='code_273' value='037300'><tr id='tr_274' onClick="goDetail('037400',274)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_274' id='chk_274' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0374</td>
							<td class='th2' style='color:#ec4261' id='td_accName_274'>기타이익잉여금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_274'>3.미처분이익</td>
							<td class='th4' style='color:#ec4261' id='td_relname_274'></td>
						</tr>
						<input type='hidden' id='Scode_274' value='11'>
						<input type='hidden' name='code_274' value='037400'><tr id='tr_275' onClick="goDetail('037500',275)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_275' id='chk_275' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0375</td>
							<td class='th2' style='color:#ec4261' id='td_accName_275'>이월이익잉여금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_275'>4.차기이월</td>
							<td class='th4' style='color:#ec4261' id='td_relname_275'></td>
						</tr>
						<input type='hidden' id='Scode_275' value='11'>
						<input type='hidden' name='code_275' value='037500'><tr id='tr_276' onClick="goDetail('037600',276)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_276' id='chk_276' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0376</td>
							<td class='th2' style='color:#ec4261' id='td_accName_276'>이월결손금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_276'>4.차기이월</td>
							<td class='th4' style='color:#ec4261' id='td_relname_276'></td>
						</tr>
						<input type='hidden' id='Scode_276' value='11'>
						<input type='hidden' name='code_276' value='037600'><tr id='tr_277' onClick="goDetail('037700',277)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_277' id='chk_277' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0377</td>
							<td class='th2' style='color:#ec4261' id='td_accName_277'>미처분이익잉여금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_277'>4.차기이월</td>
							<td class='th4' style='color:#ec4261' id='td_relname_277'></td>
						</tr>
						<input type='hidden' id='Scode_277' value='11'>
						<input type='hidden' name='code_277' value='037700'><tr id='tr_278' onClick="goDetail('037800',278)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_278' id='chk_278' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0378</td>
							<td class='th2' style='color:#ec4261' id='td_accName_278'>미처리결손금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_278'>4.차기이월</td>
							<td class='th4' style='color:#ec4261' id='td_relname_278'></td>
						</tr>
						<input type='hidden' id='Scode_278' value='11'>
						<input type='hidden' name='code_278' value='037800'><tr id='tr_279' onClick="goDetail('037900',279)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_279' id='chk_279' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0379</td>
							<td class='th2' style='color:#ec4261' id='td_accName_279'>당기순이익 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_279'>4.차기이월</td>
							<td class='th4' style='color:#ec4261' id='td_relname_279'></td>
						</tr>
						<input type='hidden' id='Scode_279' value='11'>
						<input type='hidden' name='code_279' value='037900'><tr id='tr_280' onClick="goDetail('038000',280)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_280' id='chk_280' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0380</td>
							<td class='th2' style='color:#ec4261' id='td_accName_280'>당기순손실 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_280'>4.차기이월</td>
							<td class='th4' style='color:#ec4261' id='td_relname_280'></td>
						</tr>
						<input type='hidden' id='Scode_280' value='11'>
						<input type='hidden' name='code_280' value='038000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_12' id='S_12' style='height:12px' value='Y' onClick="chk_Scode('12')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='12'>자본조정</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_281' onClick="goDetail('038100',281)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_281' id='chk_281' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0381</td>
							<td class='th2' style='color:#ec4261' id='td_accName_281'>주식할인발행차금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_281'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_281'></td>
						</tr>
						<input type='hidden' id='Scode_281' value='12'>
						<input type='hidden' name='code_281' value='038100'><tr id='tr_282' onClick="goDetail('038200',282)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_282' id='chk_282' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0382</td>
							<td class='th2' style='color:#ec4261' id='td_accName_282'>배당건설이자 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_282'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_282'></td>
						</tr>
						<input type='hidden' id='Scode_282' value='12'>
						<input type='hidden' name='code_282' value='038200'><tr id='tr_283' onClick="goDetail('038300',283)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_283' id='chk_283' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0383</td>
							<td class='th2' style='color:#ec4261' id='td_accName_283'>자기주식 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_283'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_283'></td>
						</tr>
						<input type='hidden' id='Scode_283' value='12'>
						<input type='hidden' name='code_283' value='038300'><tr id='tr_284' onClick="goDetail('038400',284)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_284' id='chk_284' style='height:12px' value='Y' checked></td>
							<td class='th1' >0384</td>
							<td class='th2'  id='td_accName_284'>dddd </td>
							<td class='th3'  id='td_chr_284'>4.차감</td>
							<td class='th4'  id='td_relname_284'></td>
						</tr>
						<input type='hidden' id='Scode_284' value='12'>
						<input type='hidden' name='code_284' value='038400'><tr id='tr_285' onClick="goDetail('038500',285)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_285' id='chk_285' style='height:12px' value='Y' checked></td>
							<td class='th1' >0385</td>
							<td class='th2'  id='td_accName_285'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_285'></td>
							<td class='th4'  id='td_relname_285'></td>
						</tr>
						<input type='hidden' id='Scode_285' value='12'>
						<input type='hidden' name='code_285' value='038500'><tr id='tr_286' onClick="goDetail('038600',286)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_286' id='chk_286' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0386</td>
							<td class='th2' style='color:#ec4261' id='td_accName_286'>신주발행비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_286'>4.차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_286'></td>
						</tr>
						<input type='hidden' id='Scode_286' value='12'>
						<input type='hidden' name='code_286' value='038600'><tr id='tr_287' onClick="goDetail('038700',287)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_287' id='chk_287' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0387</td>
							<td class='th2' style='color:#ec4261' id='td_accName_287'>미교부주식배당금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_287'>3.증가</td>
							<td class='th4' style='color:#ec4261' id='td_relname_287'></td>
						</tr>
						<input type='hidden' id='Scode_287' value='12'>
						<input type='hidden' name='code_287' value='038700'><tr id='tr_288' onClick="goDetail('038800',288)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_288' id='chk_288' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0388</td>
							<td class='th2' style='color:#ec4261' id='td_accName_288'>신주청약증거금 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_288'>3.증가</td>
							<td class='th4' style='color:#ec4261' id='td_relname_288'></td>
						</tr>
						<input type='hidden' id='Scode_288' value='12'>
						<input type='hidden' name='code_288' value='038800'><tr id='tr_289' onClick="goDetail('038900',289)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_289' id='chk_289' style='height:12px' value='Y' checked></td>
							<td class='th1' >0389</td>
							<td class='th2'  id='td_accName_289'>감자차손 </td>
							<td class='th3'  id='td_chr_289'>4.차감</td>
							<td class='th4'  id='td_relname_289'></td>
						</tr>
						<input type='hidden' id='Scode_289' value='12'>
						<input type='hidden' name='code_289' value='038900'><tr id='tr_290' onClick="goDetail('039000',290)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_290' id='chk_290' style='height:12px' value='Y' checked></td>
							<td class='th1' >0390</td>
							<td class='th2'  id='td_accName_290'>자기주식처분손실 </td>
							<td class='th3'  id='td_chr_290'>4.차감</td>
							<td class='th4'  id='td_relname_290'></td>
						</tr>
						<input type='hidden' id='Scode_290' value='12'>
						<input type='hidden' name='code_290' value='039000'><tr id='tr_291' onClick="goDetail('039100',291)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_291' id='chk_291' style='height:12px' value='Y' checked></td>
							<td class='th1' >0391</td>
							<td class='th2'  id='td_accName_291'>주식매입선택권 </td>
							<td class='th3'  id='td_chr_291'>3.증가</td>
							<td class='th4'  id='td_relname_291'></td>
						</tr>
						<input type='hidden' id='Scode_291' value='12'>
						<input type='hidden' name='code_291' value='039100'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_13' id='S_13' style='height:12px' value='Y' onClick="chk_Scode('13')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='13'>기타포괄손익누계액</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_292' onClick="goDetail('039200',292)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_292' id='chk_292' style='height:12px' value='Y' checked></td>
							<td class='th1' >0392</td>
							<td class='th2'  id='td_accName_292'>재평가차익 </td>
							<td class='th3'  id='td_chr_292'>3.평가이익</td>
							<td class='th4'  id='td_relname_292'></td>
						</tr>
						<input type='hidden' id='Scode_292' value='13'>
						<input type='hidden' name='code_292' value='039200'><tr id='tr_293' onClick="goDetail('039300',293)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_293' id='chk_293' style='height:12px' value='Y' checked></td>
							<td class='th1' >0393</td>
							<td class='th2'  id='td_accName_293'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_293'></td>
							<td class='th4'  id='td_relname_293'></td>
						</tr>
						<input type='hidden' id='Scode_293' value='13'>
						<input type='hidden' name='code_293' value='039300'><tr id='tr_294' onClick="goDetail('039400',294)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_294' id='chk_294' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0394</td>
							<td class='th2' style='color:#ec4261' id='td_accName_294'>매도가능증권평가이익 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_294'>3.평가이익</td>
							<td class='th4' style='color:#ec4261' id='td_relname_294'></td>
						</tr>
						<input type='hidden' id='Scode_294' value='13'>
						<input type='hidden' name='code_294' value='039400'><tr id='tr_295' onClick="goDetail('039500',295)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_295' id='chk_295' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0395</td>
							<td class='th2' style='color:#ec4261' id='td_accName_295'>매도가능증권평가손실 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_295'>4.평가손실</td>
							<td class='th4' style='color:#ec4261' id='td_relname_295'></td>
						</tr>
						<input type='hidden' id='Scode_295' value='13'>
						<input type='hidden' name='code_295' value='039500'><tr id='tr_296' onClick="goDetail('039600',296)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_296' id='chk_296' style='height:12px' value='Y' checked></td>
							<td class='th1' >0396</td>
							<td class='th2'  id='td_accName_296'>해외사업환산이익 </td>
							<td class='th3'  id='td_chr_296'>3.평가이익</td>
							<td class='th4'  id='td_relname_296'></td>
						</tr>
						<input type='hidden' id='Scode_296' value='13'>
						<input type='hidden' name='code_296' value='039600'><tr id='tr_297' onClick="goDetail('039700',297)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_297' id='chk_297' style='height:12px' value='Y' checked></td>
							<td class='th1' >0397</td>
							<td class='th2'  id='td_accName_297'>해외사업환산손실 </td>
							<td class='th3'  id='td_chr_297'>4.평가손실</td>
							<td class='th4'  id='td_relname_297'></td>
						</tr>
						<input type='hidden' id='Scode_297' value='13'>
						<input type='hidden' name='code_297' value='039700'><tr id='tr_298' onClick="goDetail('039800',298)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_298' id='chk_298' style='height:12px' value='Y' checked></td>
							<td class='th1' >0398</td>
							<td class='th2'  id='td_accName_298'>파생상품평가이익 </td>
							<td class='th3'  id='td_chr_298'>3.평가이익</td>
							<td class='th4'  id='td_relname_298'></td>
						</tr>
						<input type='hidden' id='Scode_298' value='13'>
						<input type='hidden' name='code_298' value='039800'><tr id='tr_299' onClick="goDetail('039900',299)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_299' id='chk_299' style='height:12px' value='Y' checked></td>
							<td class='th1' >0399</td>
							<td class='th2'  id='td_accName_299'>파생상품평가손실 </td>
							<td class='th3'  id='td_chr_299'>4.평가손실</td>
							<td class='th4'  id='td_relname_299'></td>
						</tr>
						<input type='hidden' id='Scode_299' value='13'>
						<input type='hidden' name='code_299' value='039900'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_14' id='S_14' style='height:12px' value='Y' onClick="chk_Scode('14')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='14'>손익</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_300' onClick="goDetail('040000',300)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_300' id='chk_300' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0400</td>
							<td class='th2' style='color:#ec4261' id='td_accName_300'>손익 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_300'></td>
							<td class='th4' style='color:#ec4261' id='td_relname_300'></td>
						</tr>
						<input type='hidden' id='Scode_300' value='14'>
						<input type='hidden' name='code_300' value='040000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_15' id='S_15' style='height:12px' value='Y' onClick="chk_Scode('15')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='15'>매출</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_301' onClick="goDetail('040100',301)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_301' id='chk_301' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0401</td>
							<td class='th2' style='color:#ec4261' id='td_accName_301'>상품매출 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_301'>1.매출</td>
							<td class='th4' style='color:#ec4261' id='td_relname_301'></td>
						</tr>
						<input type='hidden' id='Scode_301' value='15'>
						<input type='hidden' name='code_301' value='040100'><tr id='tr_302' onClick="goDetail('040200',302)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_302' id='chk_302' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0402</td>
							<td class='th2' style='color:#ec4261' id='td_accName_302'>매출환입및에누리 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_302'>2.환입차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_302'>상품매출</td>
						</tr>
						<input type='hidden' id='Scode_302' value='15'>
						<input type='hidden' name='code_302' value='040200'><tr id='tr_303' onClick="goDetail('040300',303)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_303' id='chk_303' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0403</td>
							<td class='th2' style='color:#ec4261' id='td_accName_303'>매출할인 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_303'>3.할인차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_303'>상품매출</td>
						</tr>
						<input type='hidden' id='Scode_303' value='15'>
						<input type='hidden' name='code_303' value='040300'><tr id='tr_304' onClick="goDetail('040400',304)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_304' id='chk_304' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0404</td>
							<td class='th2' style='color:#ec4261' id='td_accName_304'>제품매출 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_304'>1.매출</td>
							<td class='th4' style='color:#ec4261' id='td_relname_304'></td>
						</tr>
						<input type='hidden' id='Scode_304' value='15'>
						<input type='hidden' name='code_304' value='040400'><tr id='tr_305' onClick="goDetail('040500',305)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_305' id='chk_305' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0405</td>
							<td class='th2' style='color:#ec4261' id='td_accName_305'>매출환입및에누리 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_305'>2.환입차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_305'>제품매출</td>
						</tr>
						<input type='hidden' id='Scode_305' value='15'>
						<input type='hidden' name='code_305' value='040500'><tr id='tr_306' onClick="goDetail('040600',306)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_306' id='chk_306' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0406</td>
							<td class='th2' style='color:#ec4261' id='td_accName_306'>매출할인 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_306'>3.할인차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_306'>제품매출</td>
						</tr>
						<input type='hidden' id='Scode_306' value='15'>
						<input type='hidden' name='code_306' value='040600'><tr id='tr_307' onClick="goDetail('040700',307)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_307' id='chk_307' style='height:12px' value='Y' checked></td>
							<td class='th1' >0407</td>
							<td class='th2'  id='td_accName_307'>공사매출 </td>
							<td class='th3'  id='td_chr_307'>1.매출</td>
							<td class='th4'  id='td_relname_307'></td>
						</tr>
						<input type='hidden' id='Scode_307' value='15'>
						<input type='hidden' name='code_307' value='040700'><tr id='tr_308' onClick="goDetail('040800',308)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_308' id='chk_308' style='height:12px' value='Y' checked></td>
							<td class='th1' >0408</td>
							<td class='th2'  id='td_accName_308'>매출할인 </td>
							<td class='th3'  id='td_chr_308'>3.할인차감</td>
							<td class='th4'  id='td_relname_308'>공사매출</td>
						</tr>
						<input type='hidden' id='Scode_308' value='15'>
						<input type='hidden' name='code_308' value='040800'><tr id='tr_309' onClick="goDetail('040900',309)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_309' id='chk_309' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0409</td>
							<td class='th2' style='color:#ec4261' id='td_accName_309'>완성건물매출 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_309'>1.매출</td>
							<td class='th4' style='color:#ec4261' id='td_relname_309'></td>
						</tr>
						<input type='hidden' id='Scode_309' value='15'>
						<input type='hidden' name='code_309' value='040900'><tr id='tr_310' onClick="goDetail('041000',310)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_310' id='chk_310' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0410</td>
							<td class='th2' style='color:#ec4261' id='td_accName_310'>매출할인 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_310'>3.할인차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_310'>완성건물매출</td>
						</tr>
						<input type='hidden' id='Scode_310' value='15'>
						<input type='hidden' name='code_310' value='041000'><tr id='tr_311' onClick="goDetail('041100',311)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_311' id='chk_311' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0411</td>
							<td class='th2' style='color:#ec4261' id='td_accName_311'>임대료수입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_311'>1.매출</td>
							<td class='th4' style='color:#ec4261' id='td_relname_311'></td>
						</tr>
						<input type='hidden' id='Scode_311' value='15'>
						<input type='hidden' name='code_311' value='041100'><tr id='tr_312' onClick="goDetail('041200',312)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_312' id='chk_312' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0412</td>
							<td class='th2' style='color:#ec4261' id='td_accName_312'>매출환입및에누리 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_312'>2.환입차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_312'>임대료수입</td>
						</tr>
						<input type='hidden' id='Scode_312' value='15'>
						<input type='hidden' name='code_312' value='041200'><tr id='tr_313' onClick="goDetail('041300',313)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_313' id='chk_313' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0413</td>
							<td class='th2' style='color:#ec4261' id='td_accName_313'>매출할인 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_313'>3.할인차감</td>
							<td class='th4' style='color:#ec4261' id='td_relname_313'>임대료수입</td>
						</tr>
						<input type='hidden' id='Scode_313' value='15'>
						<input type='hidden' name='code_313' value='041300'><tr id='tr_314' onClick="goDetail('041400',314)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_314' id='chk_314' style='height:12px' value='Y' checked></td>
							<td class='th1' >0414</td>
							<td class='th2'  id='td_accName_314'>보관료수입 </td>
							<td class='th3'  id='td_chr_314'>1.매출</td>
							<td class='th4'  id='td_relname_314'></td>
						</tr>
						<input type='hidden' id='Scode_314' value='15'>
						<input type='hidden' name='code_314' value='041400'><tr id='tr_315' onClick="goDetail('041500',315)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_315' id='chk_315' style='height:12px' value='Y' checked></td>
							<td class='th1' >0415</td>
							<td class='th2'  id='td_accName_315'>매출환입및에누리 </td>
							<td class='th3'  id='td_chr_315'>2.환입차감</td>
							<td class='th4'  id='td_relname_315'>보관료수입</td>
						</tr>
						<input type='hidden' id='Scode_315' value='15'>
						<input type='hidden' name='code_315' value='041500'><tr id='tr_316' onClick="goDetail('041600',316)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_316' id='chk_316' style='height:12px' value='Y' checked></td>
							<td class='th1' >0416</td>
							<td class='th2'  id='td_accName_316'>매출할인 </td>
							<td class='th3'  id='td_chr_316'>3.할인차감</td>
							<td class='th4'  id='td_relname_316'>보관료수입</td>
						</tr>
						<input type='hidden' id='Scode_316' value='15'>
						<input type='hidden' name='code_316' value='041600'><tr id='tr_317' onClick="goDetail('041700',317)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_317' id='chk_317' style='height:12px' value='Y' checked></td>
							<td class='th1' >0417</td>
							<td class='th2'  id='td_accName_317'>운송료수입 </td>
							<td class='th3'  id='td_chr_317'>1.매출</td>
							<td class='th4'  id='td_relname_317'></td>
						</tr>
						<input type='hidden' id='Scode_317' value='15'>
						<input type='hidden' name='code_317' value='041700'><tr id='tr_318' onClick="goDetail('041800',318)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_318' id='chk_318' style='height:12px' value='Y' checked></td>
							<td class='th1' >0418</td>
							<td class='th2'  id='td_accName_318'>매출환입및에누리 </td>
							<td class='th3'  id='td_chr_318'>2.환입차감</td>
							<td class='th4'  id='td_relname_318'>운송료수입</td>
						</tr>
						<input type='hidden' id='Scode_318' value='15'>
						<input type='hidden' name='code_318' value='041800'><tr id='tr_319' onClick="goDetail('041900',319)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_319' id='chk_319' style='height:12px' value='Y' checked></td>
							<td class='th1' >0419</td>
							<td class='th2'  id='td_accName_319'>매출할인 </td>
							<td class='th3'  id='td_chr_319'>3.할인차감</td>
							<td class='th4'  id='td_relname_319'>운송료수입</td>
						</tr>
						<input type='hidden' id='Scode_319' value='15'>
						<input type='hidden' name='code_319' value='041900'><tr id='tr_320' onClick="goDetail('042000',320)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_320' id='chk_320' style='height:12px' value='Y' checked></td>
							<td class='th1' >0420</td>
							<td class='th2'  id='td_accName_320'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_320'></td>
							<td class='th4'  id='td_relname_320'></td>
						</tr>
						<input type='hidden' id='Scode_320' value='15'>
						<input type='hidden' name='code_320' value='042000'><tr id='tr_321' onClick="goDetail('042100',321)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_321' id='chk_321' style='height:12px' value='Y' checked></td>
							<td class='th1' >0421</td>
							<td class='th2'  id='td_accName_321'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_321'></td>
							<td class='th4'  id='td_relname_321'></td>
						</tr>
						<input type='hidden' id='Scode_321' value='15'>
						<input type='hidden' name='code_321' value='042100'><tr id='tr_322' onClick="goDetail('042200',322)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_322' id='chk_322' style='height:12px' value='Y' checked></td>
							<td class='th1' >0422</td>
							<td class='th2'  id='td_accName_322'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_322'></td>
							<td class='th4'  id='td_relname_322'></td>
						</tr>
						<input type='hidden' id='Scode_322' value='15'>
						<input type='hidden' name='code_322' value='042200'><tr id='tr_323' onClick="goDetail('042300',323)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_323' id='chk_323' style='height:12px' value='Y' checked></td>
							<td class='th1' >0423</td>
							<td class='th2'  id='td_accName_323'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_323'></td>
							<td class='th4'  id='td_relname_323'></td>
						</tr>
						<input type='hidden' id='Scode_323' value='15'>
						<input type='hidden' name='code_323' value='042300'><tr id='tr_324' onClick="goDetail('042400',324)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_324' id='chk_324' style='height:12px' value='Y' checked></td>
							<td class='th1' >0424</td>
							<td class='th2'  id='td_accName_324'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_324'></td>
							<td class='th4'  id='td_relname_324'></td>
						</tr>
						<input type='hidden' id='Scode_324' value='15'>
						<input type='hidden' name='code_324' value='042400'><tr id='tr_325' onClick="goDetail('042500',325)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_325' id='chk_325' style='height:12px' value='Y' checked></td>
							<td class='th1' >0425</td>
							<td class='th2'  id='td_accName_325'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_325'></td>
							<td class='th4'  id='td_relname_325'></td>
						</tr>
						<input type='hidden' id='Scode_325' value='15'>
						<input type='hidden' name='code_325' value='042500'><tr id='tr_326' onClick="goDetail('042600',326)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_326' id='chk_326' style='height:12px' value='Y' checked></td>
							<td class='th1' >0426</td>
							<td class='th2'  id='td_accName_326'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_326'></td>
							<td class='th4'  id='td_relname_326'></td>
						</tr>
						<input type='hidden' id='Scode_326' value='15'>
						<input type='hidden' name='code_326' value='042600'><tr id='tr_327' onClick="goDetail('042700',327)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_327' id='chk_327' style='height:12px' value='Y' checked></td>
							<td class='th1' >0427</td>
							<td class='th2'  id='td_accName_327'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_327'></td>
							<td class='th4'  id='td_relname_327'></td>
						</tr>
						<input type='hidden' id='Scode_327' value='15'>
						<input type='hidden' name='code_327' value='042700'><tr id='tr_328' onClick="goDetail('042800',328)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_328' id='chk_328' style='height:12px' value='Y' checked></td>
							<td class='th1' >0428</td>
							<td class='th2'  id='td_accName_328'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_328'></td>
							<td class='th4'  id='td_relname_328'></td>
						</tr>
						<input type='hidden' id='Scode_328' value='15'>
						<input type='hidden' name='code_328' value='042800'><tr id='tr_329' onClick="goDetail('042900',329)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_329' id='chk_329' style='height:12px' value='Y' checked></td>
							<td class='th1' >0429</td>
							<td class='th2'  id='td_accName_329'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_329'></td>
							<td class='th4'  id='td_relname_329'></td>
						</tr>
						<input type='hidden' id='Scode_329' value='15'>
						<input type='hidden' name='code_329' value='042900'><tr id='tr_330' onClick="goDetail('043000',330)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_330' id='chk_330' style='height:12px' value='Y' checked></td>
							<td class='th1' >0430</td>
							<td class='th2'  id='td_accName_330'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_330'></td>
							<td class='th4'  id='td_relname_330'></td>
						</tr>
						<input type='hidden' id='Scode_330' value='15'>
						<input type='hidden' name='code_330' value='043000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_16' id='S_16' style='height:12px' value='Y' onClick="chk_Scode('16')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='16'>매출원가</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_331' onClick="goDetail('045100',331)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_331' id='chk_331' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0451</td>
							<td class='th2' style='color:#ec4261' id='td_accName_331'>상품매출원가 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_331'>3.매입판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_331'>상품</td>
						</tr>
						<input type='hidden' id='Scode_331' value='16'>
						<input type='hidden' name='code_331' value='045100'><tr id='tr_332' onClick="goDetail('045200',332)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_332' id='chk_332' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0452</td>
							<td class='th2' style='color:#ec4261' id='td_accName_332'>도급공사매출원가 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_332'>1.용역</td>
							<td class='th4' style='color:#ec4261' id='td_relname_332'></td>
						</tr>
						<input type='hidden' id='Scode_332' value='16'>
						<input type='hidden' name='code_332' value='045200'><tr id='tr_333' onClick="goDetail('045300',333)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_333' id='chk_333' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0453</td>
							<td class='th2' style='color:#ec4261' id='td_accName_333'>분양공사매출원가 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_333'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_333'>완성건물</td>
						</tr>
						<input type='hidden' id='Scode_333' value='16'>
						<input type='hidden' name='code_333' value='045300'><tr id='tr_334' onClick="goDetail('045400',334)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_334' id='chk_334' style='height:12px' value='Y' checked></td>
							<td class='th1' >0454</td>
							<td class='th2'  id='td_accName_334'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_334'></td>
							<td class='th4'  id='td_relname_334'></td>
						</tr>
						<input type='hidden' id='Scode_334' value='16'>
						<input type='hidden' name='code_334' value='045400'><tr id='tr_335' onClick="goDetail('045500',335)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_335' id='chk_335' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0455</td>
							<td class='th2' style='color:#ec4261' id='td_accName_335'>제품매출원가 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_335'>2.제조판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_335'>제품</td>
						</tr>
						<input type='hidden' id='Scode_335' value='16'>
						<input type='hidden' name='code_335' value='045500'><tr id='tr_336' onClick="goDetail('045600',336)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_336' id='chk_336' style='height:12px' value='Y' checked></td>
							<td class='th1' >0456</td>
							<td class='th2'  id='td_accName_336'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_336'></td>
							<td class='th4'  id='td_relname_336'></td>
						</tr>
						<input type='hidden' id='Scode_336' value='16'>
						<input type='hidden' name='code_336' value='045600'><tr id='tr_337' onClick="goDetail('045700',337)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_337' id='chk_337' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0457</td>
							<td class='th2' style='color:#ec4261' id='td_accName_337'>보관매출원가 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_337'>1.용역</td>
							<td class='th4' style='color:#ec4261' id='td_relname_337'></td>
						</tr>
						<input type='hidden' id='Scode_337' value='16'>
						<input type='hidden' name='code_337' value='045700'><tr id='tr_338' onClick="goDetail('045800',338)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_338' id='chk_338' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0458</td>
							<td class='th2' style='color:#ec4261' id='td_accName_338'>운송매출원가 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_338'>1.용역</td>
							<td class='th4' style='color:#ec4261' id='td_relname_338'></td>
						</tr>
						<input type='hidden' id='Scode_338' value='16'>
						<input type='hidden' name='code_338' value='045800'><tr id='tr_339' onClick="goDetail('045900',339)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_339' id='chk_339' style='height:12px' value='Y' checked></td>
							<td class='th1' >0459</td>
							<td class='th2'  id='td_accName_339'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_339'></td>
							<td class='th4'  id='td_relname_339'></td>
						</tr>
						<input type='hidden' id='Scode_339' value='16'>
						<input type='hidden' name='code_339' value='045900'><tr id='tr_340' onClick="goDetail('046000',340)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_340' id='chk_340' style='height:12px' value='Y' checked></td>
							<td class='th1' >0460</td>
							<td class='th2'  id='td_accName_340'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_340'></td>
							<td class='th4'  id='td_relname_340'></td>
						</tr>
						<input type='hidden' id='Scode_340' value='16'>
						<input type='hidden' name='code_340' value='046000'><tr id='tr_341' onClick="goDetail('046100',341)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_341' id='chk_341' style='height:12px' value='Y' checked></td>
							<td class='th1' >0461</td>
							<td class='th2'  id='td_accName_341'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_341'></td>
							<td class='th4'  id='td_relname_341'></td>
						</tr>
						<input type='hidden' id='Scode_341' value='16'>
						<input type='hidden' name='code_341' value='046100'><tr id='tr_342' onClick="goDetail('046200',342)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_342' id='chk_342' style='height:12px' value='Y' checked></td>
							<td class='th1' >0462</td>
							<td class='th2'  id='td_accName_342'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_342'></td>
							<td class='th4'  id='td_relname_342'></td>
						</tr>
						<input type='hidden' id='Scode_342' value='16'>
						<input type='hidden' name='code_342' value='046200'><tr id='tr_343' onClick="goDetail('046300',343)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_343' id='chk_343' style='height:12px' value='Y' checked></td>
							<td class='th1' >0463</td>
							<td class='th2'  id='td_accName_343'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_343'></td>
							<td class='th4'  id='td_relname_343'></td>
						</tr>
						<input type='hidden' id='Scode_343' value='16'>
						<input type='hidden' name='code_343' value='046300'><tr id='tr_344' onClick="goDetail('046400',344)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_344' id='chk_344' style='height:12px' value='Y' checked></td>
							<td class='th1' >0464</td>
							<td class='th2'  id='td_accName_344'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_344'></td>
							<td class='th4'  id='td_relname_344'></td>
						</tr>
						<input type='hidden' id='Scode_344' value='16'>
						<input type='hidden' name='code_344' value='046400'><tr id='tr_345' onClick="goDetail('046500',345)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_345' id='chk_345' style='height:12px' value='Y' checked></td>
							<td class='th1' >0465</td>
							<td class='th2'  id='td_accName_345'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_345'></td>
							<td class='th4'  id='td_relname_345'></td>
						</tr>
						<input type='hidden' id='Scode_345' value='16'>
						<input type='hidden' name='code_345' value='046500'><tr id='tr_346' onClick="goDetail('046600',346)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_346' id='chk_346' style='height:12px' value='Y' checked></td>
							<td class='th1' >0466</td>
							<td class='th2'  id='td_accName_346'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_346'></td>
							<td class='th4'  id='td_relname_346'></td>
						</tr>
						<input type='hidden' id='Scode_346' value='16'>
						<input type='hidden' name='code_346' value='046600'><tr id='tr_347' onClick="goDetail('046700',347)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_347' id='chk_347' style='height:12px' value='Y' checked></td>
							<td class='th1' >0467</td>
							<td class='th2'  id='td_accName_347'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_347'></td>
							<td class='th4'  id='td_relname_347'></td>
						</tr>
						<input type='hidden' id='Scode_347' value='16'>
						<input type='hidden' name='code_347' value='046700'><tr id='tr_348' onClick="goDetail('046800',348)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_348' id='chk_348' style='height:12px' value='Y' checked></td>
							<td class='th1' >0468</td>
							<td class='th2'  id='td_accName_348'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_348'></td>
							<td class='th4'  id='td_relname_348'></td>
						</tr>
						<input type='hidden' id='Scode_348' value='16'>
						<input type='hidden' name='code_348' value='046800'><tr id='tr_349' onClick="goDetail('046900',349)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_349' id='chk_349' style='height:12px' value='Y' checked></td>
							<td class='th1' >0469</td>
							<td class='th2'  id='td_accName_349'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_349'></td>
							<td class='th4'  id='td_relname_349'></td>
						</tr>
						<input type='hidden' id='Scode_349' value='16'>
						<input type='hidden' name='code_349' value='046900'><tr id='tr_350' onClick="goDetail('047000',350)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_350' id='chk_350' style='height:12px' value='Y' checked></td>
							<td class='th1' >0470</td>
							<td class='th2'  id='td_accName_350'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_350'></td>
							<td class='th4'  id='td_relname_350'></td>
						</tr>
						<input type='hidden' id='Scode_350' value='16'>
						<input type='hidden' name='code_350' value='047000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_4' id='S_4' style='height:12px' value='Y' onClick="chk_Scode('4')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='4'>유형자산</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_351' onClick="goDetail('047100',351)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_351' id='chk_351' style='height:12px' value='Y' checked></td>
							<td class='th1' >0471</td>
							<td class='th2'  id='td_accName_351'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_351'>1.용역</td>
							<td class='th4'  id='td_relname_351'></td>
						</tr>
						<input type='hidden' id='Scode_351' value='4'>
						<input type='hidden' name='code_351' value='047100'><tr id='tr_352' onClick="goDetail('047200',352)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_352' id='chk_352' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0472</td>
							<td class='th2' style='color:#ec4261' id='td_accName_352'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_352'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_352'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_352' value='4'>
						<input type='hidden' name='code_352' value='047200'><tr id='tr_353' onClick="goDetail('047300',353)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_353' id='chk_353' style='height:12px' value='Y' checked></td>
							<td class='th1' >0473</td>
							<td class='th2'  id='td_accName_353'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_353'>1.용역</td>
							<td class='th4'  id='td_relname_353'></td>
						</tr>
						<input type='hidden' id='Scode_353' value='4'>
						<input type='hidden' name='code_353' value='047300'><tr id='tr_354' onClick="goDetail('047400',354)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_354' id='chk_354' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0474</td>
							<td class='th2' style='color:#ec4261' id='td_accName_354'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_354'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_354'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_354' value='4'>
						<input type='hidden' name='code_354' value='047400'><tr id='tr_355' onClick="goDetail('047500',355)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_355' id='chk_355' style='height:12px' value='Y' checked></td>
							<td class='th1' >0475</td>
							<td class='th2'  id='td_accName_355'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_355'>1.용역</td>
							<td class='th4'  id='td_relname_355'></td>
						</tr>
						<input type='hidden' id='Scode_355' value='4'>
						<input type='hidden' name='code_355' value='047500'><tr id='tr_356' onClick="goDetail('047600',356)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_356' id='chk_356' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0476</td>
							<td class='th2' style='color:#ec4261' id='td_accName_356'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_356'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_356'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_356' value='4'>
						<input type='hidden' name='code_356' value='047600'><tr id='tr_357' onClick="goDetail('047700',357)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_357' id='chk_357' style='height:12px' value='Y' checked></td>
							<td class='th1' >0477</td>
							<td class='th2'  id='td_accName_357'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_357'>1.용역</td>
							<td class='th4'  id='td_relname_357'></td>
						</tr>
						<input type='hidden' id='Scode_357' value='4'>
						<input type='hidden' name='code_357' value='047700'><tr id='tr_358' onClick="goDetail('047800',358)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_358' id='chk_358' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0478</td>
							<td class='th2' style='color:#ec4261' id='td_accName_358'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_358'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_358'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_358' value='4'>
						<input type='hidden' name='code_358' value='047800'><tr id='tr_359' onClick="goDetail('047900',359)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_359' id='chk_359' style='height:12px' value='Y' checked></td>
							<td class='th1' >0479</td>
							<td class='th2'  id='td_accName_359'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_359'>1.용역</td>
							<td class='th4'  id='td_relname_359'></td>
						</tr>
						<input type='hidden' id='Scode_359' value='4'>
						<input type='hidden' name='code_359' value='047900'><tr id='tr_360' onClick="goDetail('048000',360)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_360' id='chk_360' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0480</td>
							<td class='th2' style='color:#ec4261' id='td_accName_360'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_360'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_360'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_360' value='4'>
						<input type='hidden' name='code_360' value='048000'><tr id='tr_361' onClick="goDetail('048100',361)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_361' id='chk_361' style='height:12px' value='Y' checked></td>
							<td class='th1' >0481</td>
							<td class='th2'  id='td_accName_361'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_361'>1.용역</td>
							<td class='th4'  id='td_relname_361'></td>
						</tr>
						<input type='hidden' id='Scode_361' value='4'>
						<input type='hidden' name='code_361' value='048100'><tr id='tr_362' onClick="goDetail('048200',362)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_362' id='chk_362' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0482</td>
							<td class='th2' style='color:#ec4261' id='td_accName_362'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_362'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_362'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_362' value='4'>
						<input type='hidden' name='code_362' value='048200'><tr id='tr_363' onClick="goDetail('048300',363)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_363' id='chk_363' style='height:12px' value='Y' checked></td>
							<td class='th1' >0483</td>
							<td class='th2'  id='td_accName_363'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_363'>1.용역</td>
							<td class='th4'  id='td_relname_363'></td>
						</tr>
						<input type='hidden' id='Scode_363' value='4'>
						<input type='hidden' name='code_363' value='048300'><tr id='tr_364' onClick="goDetail('048400',364)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_364' id='chk_364' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0484</td>
							<td class='th2' style='color:#ec4261' id='td_accName_364'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_364'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_364'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_364' value='4'>
						<input type='hidden' name='code_364' value='048400'><tr id='tr_365' onClick="goDetail('048500',365)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_365' id='chk_365' style='height:12px' value='Y' checked></td>
							<td class='th1' >0485</td>
							<td class='th2'  id='td_accName_365'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_365'>1.용역</td>
							<td class='th4'  id='td_relname_365'></td>
						</tr>
						<input type='hidden' id='Scode_365' value='4'>
						<input type='hidden' name='code_365' value='048500'><tr id='tr_366' onClick="goDetail('048600',366)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_366' id='chk_366' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0486</td>
							<td class='th2' style='color:#ec4261' id='td_accName_366'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_366'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_366'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_366' value='4'>
						<input type='hidden' name='code_366' value='048600'><tr id='tr_367' onClick="goDetail('048700',367)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_367' id='chk_367' style='height:12px' value='Y' checked></td>
							<td class='th1' >0487</td>
							<td class='th2'  id='td_accName_367'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_367'>1.용역</td>
							<td class='th4'  id='td_relname_367'></td>
						</tr>
						<input type='hidden' id='Scode_367' value='4'>
						<input type='hidden' name='code_367' value='048700'><tr id='tr_368' onClick="goDetail('048800',368)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_368' id='chk_368' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0488</td>
							<td class='th2' style='color:#ec4261' id='td_accName_368'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_368'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_368'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_368' value='4'>
						<input type='hidden' name='code_368' value='048800'><tr id='tr_369' onClick="goDetail('048900',369)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_369' id='chk_369' style='height:12px' value='Y' checked></td>
							<td class='th1' >0489</td>
							<td class='th2'  id='td_accName_369'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_369'>1.용역</td>
							<td class='th4'  id='td_relname_369'></td>
						</tr>
						<input type='hidden' id='Scode_369' value='4'>
						<input type='hidden' name='code_369' value='048900'><tr id='tr_370' onClick="goDetail('049000',370)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_370' id='chk_370' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0490</td>
							<td class='th2' style='color:#ec4261' id='td_accName_370'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_370'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_370'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_370' value='4'>
						<input type='hidden' name='code_370' value='049000'><tr id='tr_371' onClick="goDetail('049100',371)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_371' id='chk_371' style='height:12px' value='Y' checked></td>
							<td class='th1' >0491</td>
							<td class='th2'  id='td_accName_371'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_371'>1.용역</td>
							<td class='th4'  id='td_relname_371'></td>
						</tr>
						<input type='hidden' id='Scode_371' value='4'>
						<input type='hidden' name='code_371' value='049100'><tr id='tr_372' onClick="goDetail('049200',372)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_372' id='chk_372' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0492</td>
							<td class='th2' style='color:#ec4261' id='td_accName_372'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_372'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_372'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_372' value='4'>
						<input type='hidden' name='code_372' value='049200'><tr id='tr_373' onClick="goDetail('049300',373)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_373' id='chk_373' style='height:12px' value='Y' checked></td>
							<td class='th1' >0493</td>
							<td class='th2'  id='td_accName_373'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_373'>1.용역</td>
							<td class='th4'  id='td_relname_373'></td>
						</tr>
						<input type='hidden' id='Scode_373' value='4'>
						<input type='hidden' name='code_373' value='049300'><tr id='tr_374' onClick="goDetail('049400',374)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_374' id='chk_374' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0494</td>
							<td class='th2' style='color:#ec4261' id='td_accName_374'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_374'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_374'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_374' value='4'>
						<input type='hidden' name='code_374' value='049400'><tr id='tr_375' onClick="goDetail('049500',375)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_375' id='chk_375' style='height:12px' value='Y' checked></td>
							<td class='th1' >0495</td>
							<td class='th2'  id='td_accName_375'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_375'>1.용역</td>
							<td class='th4'  id='td_relname_375'></td>
						</tr>
						<input type='hidden' id='Scode_375' value='4'>
						<input type='hidden' name='code_375' value='049500'><tr id='tr_376' onClick="goDetail('049600',376)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_376' id='chk_376' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0496</td>
							<td class='th2' style='color:#ec4261' id='td_accName_376'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_376'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_376'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_376' value='4'>
						<input type='hidden' name='code_376' value='049600'><tr id='tr_377' onClick="goDetail('049700',377)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_377' id='chk_377' style='height:12px' value='Y' checked></td>
							<td class='th1' >0497</td>
							<td class='th2'  id='td_accName_377'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_377'>1.용역</td>
							<td class='th4'  id='td_relname_377'></td>
						</tr>
						<input type='hidden' id='Scode_377' value='4'>
						<input type='hidden' name='code_377' value='049700'><tr id='tr_378' onClick="goDetail('049800',378)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_378' id='chk_378' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0498</td>
							<td class='th2' style='color:#ec4261' id='td_accName_378'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_378'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_378'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_378' value='4'>
						<input type='hidden' name='code_378' value='049800'><tr id='tr_379' onClick="goDetail('049900',379)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_379' id='chk_379' style='height:12px' value='Y' checked></td>
							<td class='th1' >0499</td>
							<td class='th2'  id='td_accName_379'>사용자&nbsp;설정계정과목 </td>
							<td class='th3'  id='td_chr_379'>1.용역</td>
							<td class='th4'  id='td_relname_379'></td>
						</tr>
						<input type='hidden' id='Scode_379' value='4'>
						<input type='hidden' name='code_379' value='049900'><tr id='tr_380' onClick="goDetail('050000',380)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_380' id='chk_380' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0500</td>
							<td class='th2' style='color:#ec4261' id='td_accName_380'>감가상각누계액 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_380'>4.분양판매</td>
							<td class='th4' style='color:#ec4261' id='td_relname_380'>사용자 설정계정과목</td>
						</tr>
						<input type='hidden' id='Scode_380' value='4'>
						<input type='hidden' name='code_380' value='050000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_17' id='S_17' style='height:12px' value='Y' onClick="chk_Scode('17')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='17'>제조원가</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_381' onClick="goDetail('050100',381)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_381' id='chk_381' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0501</td>
							<td class='th2' style='color:#ec4261' id='td_accName_381'>원재료비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_381'>1.원재료비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_381'>원재료</td>
						</tr>
						<input type='hidden' id='Scode_381' value='17'>
						<input type='hidden' name='code_381' value='050100'><tr id='tr_382' onClick="goDetail('050200',382)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_382' id='chk_382' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0502</td>
							<td class='th2' style='color:#ec4261' id='td_accName_382'>부재료비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_382'>2.부재료비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_382'>부재료</td>
						</tr>
						<input type='hidden' id='Scode_382' value='17'>
						<input type='hidden' name='code_382' value='050200'><tr id='tr_383' onClick="goDetail('050300',383)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_383' id='chk_383' style='height:12px' value='Y' checked></td>
							<td class='th1' >0503</td>
							<td class='th2'  id='td_accName_383'>급여 </td>
							<td class='th3'  id='td_chr_383'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_383'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_383' value='17'>
						<input type='hidden' name='code_383' value='050300'><tr id='tr_384' onClick="goDetail('050400',384)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_384' id='chk_384' style='height:12px' value='Y' checked></td>
							<td class='th1' >0504</td>
							<td class='th2'  id='td_accName_384'>임금 </td>
							<td class='th3'  id='td_chr_384'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_384'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_384' value='17'>
						<input type='hidden' name='code_384' value='050400'><tr id='tr_385' onClick="goDetail('050500',385)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_385' id='chk_385' style='height:12px' value='Y' checked></td>
							<td class='th1' >0505</td>
							<td class='th2'  id='td_accName_385'>상여금 </td>
							<td class='th3'  id='td_chr_385'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_385'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_385' value='17'>
						<input type='hidden' name='code_385' value='050500'><tr id='tr_386' onClick="goDetail('050600',386)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_386' id='chk_386' style='height:12px' value='Y' checked></td>
							<td class='th1' >0506</td>
							<td class='th2'  id='td_accName_386'>제수당 </td>
							<td class='th3'  id='td_chr_386'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_386'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_386' value='17'>
						<input type='hidden' name='code_386' value='050600'><tr id='tr_387' onClick="goDetail('050700',387)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_387' id='chk_387' style='height:12px' value='Y' checked></td>
							<td class='th1' >0507</td>
							<td class='th2'  id='td_accName_387'>잡급 </td>
							<td class='th3'  id='td_chr_387'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_387'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_387' value='17'>
						<input type='hidden' name='code_387' value='050700'><tr id='tr_388' onClick="goDetail('050800',388)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_388' id='chk_388' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0508</td>
							<td class='th2' style='color:#ec4261' id='td_accName_388'>퇴직급여 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_388'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_388'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_388' value='17'>
						<input type='hidden' name='code_388' value='050800'><tr id='tr_389' onClick="goDetail('050900',389)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_389' id='chk_389' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0509</td>
							<td class='th2' style='color:#ec4261' id='td_accName_389'>퇴직보험충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_389'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_389'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_389' value='17'>
						<input type='hidden' name='code_389' value='050900'><tr id='tr_390' onClick="goDetail('051000',390)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_390' id='chk_390' style='height:12px' value='Y' checked></td>
							<td class='th1' >0510</td>
							<td class='th2'  id='td_accName_390'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_390'>5.제조경비</td>
							<td class='th4'  id='td_relname_390'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_390' value='17'>
						<input type='hidden' name='code_390' value='051000'><tr id='tr_391' onClick="goDetail('051100',391)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_391' id='chk_391' style='height:12px' value='Y' checked></td>
							<td class='th1' >0511</td>
							<td class='th2'  id='td_accName_391'>복리후생비 </td>
							<td class='th3'  id='td_chr_391'>5.제조경비</td>
							<td class='th4'  id='td_relname_391'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_391' value='17'>
						<input type='hidden' name='code_391' value='051100'><tr id='tr_392' onClick="goDetail('051200',392)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_392' id='chk_392' style='height:12px' value='Y' checked></td>
							<td class='th1' >0512</td>
							<td class='th2'  id='td_accName_392'>여비교통비 </td>
							<td class='th3'  id='td_chr_392'>5.제조경비</td>
							<td class='th4'  id='td_relname_392'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_392' value='17'>
						<input type='hidden' name='code_392' value='051200'><tr id='tr_393' onClick="goDetail('051300',393)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_393' id='chk_393' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0513</td>
							<td class='th2' style='color:#ec4261' id='td_accName_393'>접대비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_393'>5.제조경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_393'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_393' value='17'>
						<input type='hidden' name='code_393' value='051300'><tr id='tr_394' onClick="goDetail('051400',394)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_394' id='chk_394' style='height:12px' value='Y' checked></td>
							<td class='th1' >0514</td>
							<td class='th2'  id='td_accName_394'>통신비 </td>
							<td class='th3'  id='td_chr_394'>5.제조경비</td>
							<td class='th4'  id='td_relname_394'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_394' value='17'>
						<input type='hidden' name='code_394' value='051400'><tr id='tr_395' onClick="goDetail('051500',395)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_395' id='chk_395' style='height:12px' value='Y' checked></td>
							<td class='th1' >0515</td>
							<td class='th2'  id='td_accName_395'>가스수도료 </td>
							<td class='th3'  id='td_chr_395'>5.제조경비</td>
							<td class='th4'  id='td_relname_395'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_395' value='17'>
						<input type='hidden' name='code_395' value='051500'><tr id='tr_396' onClick="goDetail('051600',396)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_396' id='chk_396' style='height:12px' value='Y' checked></td>
							<td class='th1' >0516</td>
							<td class='th2'  id='td_accName_396'>전력비 </td>
							<td class='th3'  id='td_chr_396'>5.제조경비</td>
							<td class='th4'  id='td_relname_396'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_396' value='17'>
						<input type='hidden' name='code_396' value='051600'><tr id='tr_397' onClick="goDetail('051700',397)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_397' id='chk_397' style='height:12px' value='Y' checked></td>
							<td class='th1' >0517</td>
							<td class='th2'  id='td_accName_397'>세금과공과금 </td>
							<td class='th3'  id='td_chr_397'>5.제조경비</td>
							<td class='th4'  id='td_relname_397'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_397' value='17'>
						<input type='hidden' name='code_397' value='051700'><tr id='tr_398' onClick="goDetail('051800',398)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_398' id='chk_398' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0518</td>
							<td class='th2' style='color:#ec4261' id='td_accName_398'>감가상각비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_398'>5.제조경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_398'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_398' value='17'>
						<input type='hidden' name='code_398' value='051800'><tr id='tr_399' onClick="goDetail('051900',399)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_399' id='chk_399' style='height:12px' value='Y' checked></td>
							<td class='th1' >0519</td>
							<td class='th2'  id='td_accName_399'>임차료 </td>
							<td class='th3'  id='td_chr_399'>5.제조경비</td>
							<td class='th4'  id='td_relname_399'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_399' value='17'>
						<input type='hidden' name='code_399' value='051900'><tr id='tr_400' onClick="goDetail('052000',400)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_400' id='chk_400' style='height:12px' value='Y' checked></td>
							<td class='th1' >0520</td>
							<td class='th2'  id='td_accName_400'>수선비 </td>
							<td class='th3'  id='td_chr_400'>5.제조경비</td>
							<td class='th4'  id='td_relname_400'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_400' value='17'>
						<input type='hidden' name='code_400' value='052000'><tr id='tr_401' onClick="goDetail('052100',401)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_401' id='chk_401' style='height:12px' value='Y' checked></td>
							<td class='th1' >0521</td>
							<td class='th2'  id='td_accName_401'>보험료 </td>
							<td class='th3'  id='td_chr_401'>5.제조경비</td>
							<td class='th4'  id='td_relname_401'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_401' value='17'>
						<input type='hidden' name='code_401' value='052100'><tr id='tr_402' onClick="goDetail('052200',402)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_402' id='chk_402' style='height:12px' value='Y' checked></td>
							<td class='th1' >0522</td>
							<td class='th2'  id='td_accName_402'>차량유지비 </td>
							<td class='th3'  id='td_chr_402'>5.제조경비</td>
							<td class='th4'  id='td_relname_402'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_402' value='17'>
						<input type='hidden' name='code_402' value='052200'><tr id='tr_403' onClick="goDetail('052300',403)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_403' id='chk_403' style='height:12px' value='Y' checked></td>
							<td class='th1' >0523</td>
							<td class='th2'  id='td_accName_403'>경상연구개발비 </td>
							<td class='th3'  id='td_chr_403'>5.제조경비</td>
							<td class='th4'  id='td_relname_403'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_403' value='17'>
						<input type='hidden' name='code_403' value='052300'><tr id='tr_404' onClick="goDetail('052400',404)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_404' id='chk_404' style='height:12px' value='Y' checked></td>
							<td class='th1' >0524</td>
							<td class='th2'  id='td_accName_404'>운반비 </td>
							<td class='th3'  id='td_chr_404'>5.제조경비</td>
							<td class='th4'  id='td_relname_404'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_404' value='17'>
						<input type='hidden' name='code_404' value='052400'><tr id='tr_405' onClick="goDetail('052500',405)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_405' id='chk_405' style='height:12px' value='Y' checked></td>
							<td class='th1' >0525</td>
							<td class='th2'  id='td_accName_405'>교육훈련비 </td>
							<td class='th3'  id='td_chr_405'>5.제조경비</td>
							<td class='th4'  id='td_relname_405'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_405' value='17'>
						<input type='hidden' name='code_405' value='052500'><tr id='tr_406' onClick="goDetail('052600',406)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_406' id='chk_406' style='height:12px' value='Y' checked></td>
							<td class='th1' >0526</td>
							<td class='th2'  id='td_accName_406'>도서인쇄비 </td>
							<td class='th3'  id='td_chr_406'>5.제조경비</td>
							<td class='th4'  id='td_relname_406'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_406' value='17'>
						<input type='hidden' name='code_406' value='052600'><tr id='tr_407' onClick="goDetail('052700',407)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_407' id='chk_407' style='height:12px' value='Y' checked></td>
							<td class='th1' >0527</td>
							<td class='th2'  id='td_accName_407'>회의비 </td>
							<td class='th3'  id='td_chr_407'>5.제조경비</td>
							<td class='th4'  id='td_relname_407'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_407' value='17'>
						<input type='hidden' name='code_407' value='052700'><tr id='tr_408' onClick="goDetail('052800',408)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_408' id='chk_408' style='height:12px' value='Y' checked></td>
							<td class='th1' >0528</td>
							<td class='th2'  id='td_accName_408'>포장비 </td>
							<td class='th3'  id='td_chr_408'>5.제조경비</td>
							<td class='th4'  id='td_relname_408'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_408' value='17'>
						<input type='hidden' name='code_408' value='052800'><tr id='tr_409' onClick="goDetail('052900',409)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_409' id='chk_409' style='height:12px' value='Y' checked></td>
							<td class='th1' >0529</td>
							<td class='th2'  id='td_accName_409'>사무용품비 </td>
							<td class='th3'  id='td_chr_409'>5.제조경비</td>
							<td class='th4'  id='td_relname_409'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_409' value='17'>
						<input type='hidden' name='code_409' value='052900'><tr id='tr_410' onClick="goDetail('053000',410)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_410' id='chk_410' style='height:12px' value='Y' checked></td>
							<td class='th1' >0530</td>
							<td class='th2'  id='td_accName_410'>소모품비 </td>
							<td class='th3'  id='td_chr_410'>5.제조경비</td>
							<td class='th4'  id='td_relname_410'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_410' value='17'>
						<input type='hidden' name='code_410' value='053000'><tr id='tr_411' onClick="goDetail('053100',411)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_411' id='chk_411' style='height:12px' value='Y' checked></td>
							<td class='th1' >0531</td>
							<td class='th2'  id='td_accName_411'>수수료비용 </td>
							<td class='th3'  id='td_chr_411'>5.제조경비</td>
							<td class='th4'  id='td_relname_411'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_411' value='17'>
						<input type='hidden' name='code_411' value='053100'><tr id='tr_412' onClick="goDetail('053200',412)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_412' id='chk_412' style='height:12px' value='Y' checked></td>
							<td class='th1' >0532</td>
							<td class='th2'  id='td_accName_412'>보관료 </td>
							<td class='th3'  id='td_chr_412'>5.제조경비</td>
							<td class='th4'  id='td_relname_412'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_412' value='17'>
						<input type='hidden' name='code_412' value='053200'><tr id='tr_413' onClick="goDetail('053300',413)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_413' id='chk_413' style='height:12px' value='Y' checked></td>
							<td class='th1' >0533</td>
							<td class='th2'  id='td_accName_413'>외주가공비 </td>
							<td class='th3'  id='td_chr_413'>5.제조경비</td>
							<td class='th4'  id='td_relname_413'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_413' value='17'>
						<input type='hidden' name='code_413' value='053300'><tr id='tr_414' onClick="goDetail('053400',414)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_414' id='chk_414' style='height:12px' value='Y' checked></td>
							<td class='th1' >0534</td>
							<td class='th2'  id='td_accName_414'>시험비 </td>
							<td class='th3'  id='td_chr_414'>5.제조경비</td>
							<td class='th4'  id='td_relname_414'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_414' value='17'>
						<input type='hidden' name='code_414' value='053400'><tr id='tr_415' onClick="goDetail('053500',415)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_415' id='chk_415' style='height:12px' value='Y' checked></td>
							<td class='th1' >0535</td>
							<td class='th2'  id='td_accName_415'>기밀비 </td>
							<td class='th3'  id='td_chr_415'>5.제조경비</td>
							<td class='th4'  id='td_relname_415'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_415' value='17'>
						<input type='hidden' name='code_415' value='053500'><tr id='tr_416' onClick="goDetail('053600',416)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_416' id='chk_416' style='height:12px' value='Y' checked></td>
							<td class='th1' >0536</td>
							<td class='th2'  id='td_accName_416'>잡비 </td>
							<td class='th3'  id='td_chr_416'>5.제조경비</td>
							<td class='th4'  id='td_relname_416'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_416' value='17'>
						<input type='hidden' name='code_416' value='053600'><tr id='tr_417' onClick="goDetail('053700',417)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_417' id='chk_417' style='height:12px' value='Y' checked></td>
							<td class='th1' >0537</td>
							<td class='th2'  id='td_accName_417'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_417'>5.제조경비</td>
							<td class='th4'  id='td_relname_417'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_417' value='17'>
						<input type='hidden' name='code_417' value='053700'><tr id='tr_418' onClick="goDetail('053800',418)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_418' id='chk_418' style='height:12px' value='Y' checked></td>
							<td class='th1' >0538</td>
							<td class='th2'  id='td_accName_418'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_418'>5.제조경비</td>
							<td class='th4'  id='td_relname_418'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_418' value='17'>
						<input type='hidden' name='code_418' value='053800'><tr id='tr_419' onClick="goDetail('053900',419)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_419' id='chk_419' style='height:12px' value='Y' checked></td>
							<td class='th1' >0539</td>
							<td class='th2'  id='td_accName_419'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_419'>5.제조경비</td>
							<td class='th4'  id='td_relname_419'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_419' value='17'>
						<input type='hidden' name='code_419' value='053900'><tr id='tr_420' onClick="goDetail('054000',420)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_420' id='chk_420' style='height:12px' value='Y' checked></td>
							<td class='th1' >0540</td>
							<td class='th2'  id='td_accName_420'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_420'>5.제조경비</td>
							<td class='th4'  id='td_relname_420'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_420' value='17'>
						<input type='hidden' name='code_420' value='054000'><tr id='tr_421' onClick="goDetail('054100',421)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_421' id='chk_421' style='height:12px' value='Y' checked></td>
							<td class='th1' >0541</td>
							<td class='th2'  id='td_accName_421'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_421'>5.제조경비</td>
							<td class='th4'  id='td_relname_421'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_421' value='17'>
						<input type='hidden' name='code_421' value='054100'><tr id='tr_422' onClick="goDetail('054200',422)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_422' id='chk_422' style='height:12px' value='Y' checked></td>
							<td class='th1' >0542</td>
							<td class='th2'  id='td_accName_422'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_422'>5.제조경비</td>
							<td class='th4'  id='td_relname_422'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_422' value='17'>
						<input type='hidden' name='code_422' value='054200'><tr id='tr_423' onClick="goDetail('054300',423)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_423' id='chk_423' style='height:12px' value='Y' checked></td>
							<td class='th1' >0543</td>
							<td class='th2'  id='td_accName_423'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_423'>5.제조경비</td>
							<td class='th4'  id='td_relname_423'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_423' value='17'>
						<input type='hidden' name='code_423' value='054300'><tr id='tr_424' onClick="goDetail('054400',424)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_424' id='chk_424' style='height:12px' value='Y' checked></td>
							<td class='th1' >0544</td>
							<td class='th2'  id='td_accName_424'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_424'>5.제조경비</td>
							<td class='th4'  id='td_relname_424'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_424' value='17'>
						<input type='hidden' name='code_424' value='054400'><tr id='tr_425' onClick="goDetail('054500',425)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_425' id='chk_425' style='height:12px' value='Y' checked></td>
							<td class='th1' >0545</td>
							<td class='th2'  id='td_accName_425'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_425'>5.제조경비</td>
							<td class='th4'  id='td_relname_425'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_425' value='17'>
						<input type='hidden' name='code_425' value='054500'><tr id='tr_426' onClick="goDetail('054600',426)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_426' id='chk_426' style='height:12px' value='Y' checked></td>
							<td class='th1' >0546</td>
							<td class='th2'  id='td_accName_426'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_426'>5.제조경비</td>
							<td class='th4'  id='td_relname_426'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_426' value='17'>
						<input type='hidden' name='code_426' value='054600'><tr id='tr_427' onClick="goDetail('054700',427)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_427' id='chk_427' style='height:12px' value='Y' checked></td>
							<td class='th1' >0547</td>
							<td class='th2'  id='td_accName_427'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_427'>5.제조경비</td>
							<td class='th4'  id='td_relname_427'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_427' value='17'>
						<input type='hidden' name='code_427' value='054700'><tr id='tr_428' onClick="goDetail('054800',428)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_428' id='chk_428' style='height:12px' value='Y' checked></td>
							<td class='th1' >0548</td>
							<td class='th2'  id='td_accName_428'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_428'>5.제조경비</td>
							<td class='th4'  id='td_relname_428'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_428' value='17'>
						<input type='hidden' name='code_428' value='054800'><tr id='tr_429' onClick="goDetail('054900',429)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_429' id='chk_429' style='height:12px' value='Y' checked></td>
							<td class='th1' >0549</td>
							<td class='th2'  id='td_accName_429'>명예퇴직금 </td>
							<td class='th3'  id='td_chr_429'>4.노무비(퇴직)</td>
							<td class='th4'  id='td_relname_429'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_429' value='17'>
						<input type='hidden' name='code_429' value='054900'><tr id='tr_430' onClick="goDetail('055000',430)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_430' id='chk_430' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0550</td>
							<td class='th2' style='color:#ec4261' id='td_accName_430'>퇴직연금충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_430'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_430'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_430' value='17'>
						<input type='hidden' name='code_430' value='055000'><tr id='tr_431' onClick="goDetail('055100',431)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_431' id='chk_431' style='height:12px' value='Y' checked></td>
							<td class='th1' >0551</td>
							<td class='th2'  id='td_accName_431'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_431'>5.제조경비</td>
							<td class='th4'  id='td_relname_431'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_431' value='17'>
						<input type='hidden' name='code_431' value='055100'><tr id='tr_432' onClick="goDetail('055200',432)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_432' id='chk_432' style='height:12px' value='Y' checked></td>
							<td class='th1' >0552</td>
							<td class='th2'  id='td_accName_432'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_432'>5.제조경비</td>
							<td class='th4'  id='td_relname_432'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_432' value='17'>
						<input type='hidden' name='code_432' value='055200'><tr id='tr_433' onClick="goDetail('055300',433)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_433' id='chk_433' style='height:12px' value='Y' checked></td>
							<td class='th1' >0553</td>
							<td class='th2'  id='td_accName_433'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_433'>5.제조경비</td>
							<td class='th4'  id='td_relname_433'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_433' value='17'>
						<input type='hidden' name='code_433' value='055300'><tr id='tr_434' onClick="goDetail('055400',434)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_434' id='chk_434' style='height:12px' value='Y' checked></td>
							<td class='th1' >0554</td>
							<td class='th2'  id='td_accName_434'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_434'>5.제조경비</td>
							<td class='th4'  id='td_relname_434'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_434' value='17'>
						<input type='hidden' name='code_434' value='055400'><tr id='tr_435' onClick="goDetail('055500',435)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_435' id='chk_435' style='height:12px' value='Y' checked></td>
							<td class='th1' >0555</td>
							<td class='th2'  id='td_accName_435'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_435'>5.제조경비</td>
							<td class='th4'  id='td_relname_435'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_435' value='17'>
						<input type='hidden' name='code_435' value='055500'><tr id='tr_436' onClick="goDetail('055600',436)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_436' id='chk_436' style='height:12px' value='Y' checked></td>
							<td class='th1' >0556</td>
							<td class='th2'  id='td_accName_436'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_436'></td>
							<td class='th4'  id='td_relname_436'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_436' value='17'>
						<input type='hidden' name='code_436' value='055600'><tr id='tr_437' onClick="goDetail('055700',437)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_437' id='chk_437' style='height:12px' value='Y' checked></td>
							<td class='th1' >0557</td>
							<td class='th2'  id='td_accName_437'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_437'></td>
							<td class='th4'  id='td_relname_437'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_437' value='17'>
						<input type='hidden' name='code_437' value='055700'><tr id='tr_438' onClick="goDetail('055800',438)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_438' id='chk_438' style='height:12px' value='Y' checked></td>
							<td class='th1' >0558</td>
							<td class='th2'  id='td_accName_438'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_438'></td>
							<td class='th4'  id='td_relname_438'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_438' value='17'>
						<input type='hidden' name='code_438' value='055800'><tr id='tr_439' onClick="goDetail('055900',439)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_439' id='chk_439' style='height:12px' value='Y' checked></td>
							<td class='th1' >0559</td>
							<td class='th2'  id='td_accName_439'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_439'></td>
							<td class='th4'  id='td_relname_439'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_439' value='17'>
						<input type='hidden' name='code_439' value='055900'><tr id='tr_440' onClick="goDetail('056000',440)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_440' id='chk_440' style='height:12px' value='Y' checked></td>
							<td class='th1' >0560</td>
							<td class='th2'  id='td_accName_440'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_440'></td>
							<td class='th4'  id='td_relname_440'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_440' value='17'>
						<input type='hidden' name='code_440' value='056000'><tr id='tr_441' onClick="goDetail('056100',441)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_441' id='chk_441' style='height:12px' value='Y' checked></td>
							<td class='th1' >0561</td>
							<td class='th2'  id='td_accName_441'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_441'></td>
							<td class='th4'  id='td_relname_441'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_441' value='17'>
						<input type='hidden' name='code_441' value='056100'><tr id='tr_442' onClick="goDetail('056200',442)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_442' id='chk_442' style='height:12px' value='Y' checked></td>
							<td class='th1' >0562</td>
							<td class='th2'  id='td_accName_442'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_442'></td>
							<td class='th4'  id='td_relname_442'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_442' value='17'>
						<input type='hidden' name='code_442' value='056200'><tr id='tr_443' onClick="goDetail('056300',443)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_443' id='chk_443' style='height:12px' value='Y' checked></td>
							<td class='th1' >0563</td>
							<td class='th2'  id='td_accName_443'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_443'></td>
							<td class='th4'  id='td_relname_443'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_443' value='17'>
						<input type='hidden' name='code_443' value='056300'><tr id='tr_444' onClick="goDetail('056400',444)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_444' id='chk_444' style='height:12px' value='Y' checked></td>
							<td class='th1' >0564</td>
							<td class='th2'  id='td_accName_444'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_444'></td>
							<td class='th4'  id='td_relname_444'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_444' value='17'>
						<input type='hidden' name='code_444' value='056400'><tr id='tr_445' onClick="goDetail('056500',445)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_445' id='chk_445' style='height:12px' value='Y' checked></td>
							<td class='th1' >0565</td>
							<td class='th2'  id='td_accName_445'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_445'></td>
							<td class='th4'  id='td_relname_445'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_445' value='17'>
						<input type='hidden' name='code_445' value='056500'><tr id='tr_446' onClick="goDetail('056600',446)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_446' id='chk_446' style='height:12px' value='Y' checked></td>
							<td class='th1' >0566</td>
							<td class='th2'  id='td_accName_446'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_446'></td>
							<td class='th4'  id='td_relname_446'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_446' value='17'>
						<input type='hidden' name='code_446' value='056600'><tr id='tr_447' onClick="goDetail('056700',447)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_447' id='chk_447' style='height:12px' value='Y' checked></td>
							<td class='th1' >0567</td>
							<td class='th2'  id='td_accName_447'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_447'></td>
							<td class='th4'  id='td_relname_447'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_447' value='17'>
						<input type='hidden' name='code_447' value='056700'><tr id='tr_448' onClick="goDetail('056800',448)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_448' id='chk_448' style='height:12px' value='Y' checked></td>
							<td class='th1' >0568</td>
							<td class='th2'  id='td_accName_448'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_448'></td>
							<td class='th4'  id='td_relname_448'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_448' value='17'>
						<input type='hidden' name='code_448' value='056800'><tr id='tr_449' onClick="goDetail('056900',449)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_449' id='chk_449' style='height:12px' value='Y' checked></td>
							<td class='th1' >0569</td>
							<td class='th2'  id='td_accName_449'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_449'></td>
							<td class='th4'  id='td_relname_449'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_449' value='17'>
						<input type='hidden' name='code_449' value='056900'><tr id='tr_450' onClick="goDetail('057000',450)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_450' id='chk_450' style='height:12px' value='Y' checked></td>
							<td class='th1' >0570</td>
							<td class='th2'  id='td_accName_450'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_450'></td>
							<td class='th4'  id='td_relname_450'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_450' value='17'>
						<input type='hidden' name='code_450' value='057000'><tr id='tr_451' onClick="goDetail('057100',451)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_451' id='chk_451' style='height:12px' value='Y' checked></td>
							<td class='th1' >0571</td>
							<td class='th2'  id='td_accName_451'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_451'></td>
							<td class='th4'  id='td_relname_451'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_451' value='17'>
						<input type='hidden' name='code_451' value='057100'><tr id='tr_452' onClick="goDetail('057200',452)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_452' id='chk_452' style='height:12px' value='Y' checked></td>
							<td class='th1' >0572</td>
							<td class='th2'  id='td_accName_452'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_452'></td>
							<td class='th4'  id='td_relname_452'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_452' value='17'>
						<input type='hidden' name='code_452' value='057200'><tr id='tr_453' onClick="goDetail('057300',453)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_453' id='chk_453' style='height:12px' value='Y' checked></td>
							<td class='th1' >0573</td>
							<td class='th2'  id='td_accName_453'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_453'></td>
							<td class='th4'  id='td_relname_453'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_453' value='17'>
						<input type='hidden' name='code_453' value='057300'><tr id='tr_454' onClick="goDetail('057400',454)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_454' id='chk_454' style='height:12px' value='Y' checked></td>
							<td class='th1' >0574</td>
							<td class='th2'  id='td_accName_454'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_454'></td>
							<td class='th4'  id='td_relname_454'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_454' value='17'>
						<input type='hidden' name='code_454' value='057400'><tr id='tr_455' onClick="goDetail('057500',455)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_455' id='chk_455' style='height:12px' value='Y' checked></td>
							<td class='th1' >0575</td>
							<td class='th2'  id='td_accName_455'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_455'></td>
							<td class='th4'  id='td_relname_455'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_455' value='17'>
						<input type='hidden' name='code_455' value='057500'><tr id='tr_456' onClick="goDetail('057600',456)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_456' id='chk_456' style='height:12px' value='Y' checked></td>
							<td class='th1' >0576</td>
							<td class='th2'  id='td_accName_456'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_456'></td>
							<td class='th4'  id='td_relname_456'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_456' value='17'>
						<input type='hidden' name='code_456' value='057600'><tr id='tr_457' onClick="goDetail('057700',457)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_457' id='chk_457' style='height:12px' value='Y' checked></td>
							<td class='th1' >0577</td>
							<td class='th2'  id='td_accName_457'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_457'></td>
							<td class='th4'  id='td_relname_457'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_457' value='17'>
						<input type='hidden' name='code_457' value='057700'><tr id='tr_458' onClick="goDetail('057800',458)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_458' id='chk_458' style='height:12px' value='Y' checked></td>
							<td class='th1' >0578</td>
							<td class='th2'  id='td_accName_458'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_458'></td>
							<td class='th4'  id='td_relname_458'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_458' value='17'>
						<input type='hidden' name='code_458' value='057800'><tr id='tr_459' onClick="goDetail('057900',459)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_459' id='chk_459' style='height:12px' value='Y' checked></td>
							<td class='th1' >0579</td>
							<td class='th2'  id='td_accName_459'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_459'></td>
							<td class='th4'  id='td_relname_459'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_459' value='17'>
						<input type='hidden' name='code_459' value='057900'><tr id='tr_460' onClick="goDetail('058000',460)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_460' id='chk_460' style='height:12px' value='Y' checked></td>
							<td class='th1' >0580</td>
							<td class='th2'  id='td_accName_460'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_460'></td>
							<td class='th4'  id='td_relname_460'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_460' value='17'>
						<input type='hidden' name='code_460' value='058000'><tr id='tr_461' onClick="goDetail('058100',461)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_461' id='chk_461' style='height:12px' value='Y' checked></td>
							<td class='th1' >0581</td>
							<td class='th2'  id='td_accName_461'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_461'></td>
							<td class='th4'  id='td_relname_461'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_461' value='17'>
						<input type='hidden' name='code_461' value='058100'><tr id='tr_462' onClick="goDetail('058200',462)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_462' id='chk_462' style='height:12px' value='Y' checked></td>
							<td class='th1' >0582</td>
							<td class='th2'  id='td_accName_462'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_462'></td>
							<td class='th4'  id='td_relname_462'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_462' value='17'>
						<input type='hidden' name='code_462' value='058200'><tr id='tr_463' onClick="goDetail('058300',463)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_463' id='chk_463' style='height:12px' value='Y' checked></td>
							<td class='th1' >0583</td>
							<td class='th2'  id='td_accName_463'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_463'></td>
							<td class='th4'  id='td_relname_463'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_463' value='17'>
						<input type='hidden' name='code_463' value='058300'><tr id='tr_464' onClick="goDetail('058400',464)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_464' id='chk_464' style='height:12px' value='Y' checked></td>
							<td class='th1' >0584</td>
							<td class='th2'  id='td_accName_464'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_464'></td>
							<td class='th4'  id='td_relname_464'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_464' value='17'>
						<input type='hidden' name='code_464' value='058400'><tr id='tr_465' onClick="goDetail('058500',465)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_465' id='chk_465' style='height:12px' value='Y' checked></td>
							<td class='th1' >0585</td>
							<td class='th2'  id='td_accName_465'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_465'></td>
							<td class='th4'  id='td_relname_465'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_465' value='17'>
						<input type='hidden' name='code_465' value='058500'><tr id='tr_466' onClick="goDetail('058600',466)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_466' id='chk_466' style='height:12px' value='Y' checked></td>
							<td class='th1' >0586</td>
							<td class='th2'  id='td_accName_466'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_466'></td>
							<td class='th4'  id='td_relname_466'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_466' value='17'>
						<input type='hidden' name='code_466' value='058600'><tr id='tr_467' onClick="goDetail('058700',467)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_467' id='chk_467' style='height:12px' value='Y' checked></td>
							<td class='th1' >0587</td>
							<td class='th2'  id='td_accName_467'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_467'></td>
							<td class='th4'  id='td_relname_467'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_467' value='17'>
						<input type='hidden' name='code_467' value='058700'><tr id='tr_468' onClick="goDetail('058800',468)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_468' id='chk_468' style='height:12px' value='Y' checked></td>
							<td class='th1' >0588</td>
							<td class='th2'  id='td_accName_468'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_468'></td>
							<td class='th4'  id='td_relname_468'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_468' value='17'>
						<input type='hidden' name='code_468' value='058800'><tr id='tr_469' onClick="goDetail('058900',469)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_469' id='chk_469' style='height:12px' value='Y' checked></td>
							<td class='th1' >0589</td>
							<td class='th2'  id='td_accName_469'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_469'></td>
							<td class='th4'  id='td_relname_469'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_469' value='17'>
						<input type='hidden' name='code_469' value='058900'><tr id='tr_470' onClick="goDetail('059000',470)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_470' id='chk_470' style='height:12px' value='Y' checked></td>
							<td class='th1' >0590</td>
							<td class='th2'  id='td_accName_470'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_470'></td>
							<td class='th4'  id='td_relname_470'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_470' value='17'>
						<input type='hidden' name='code_470' value='059000'><tr id='tr_471' onClick="goDetail('059100',471)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_471' id='chk_471' style='height:12px' value='Y' checked></td>
							<td class='th1' >0591</td>
							<td class='th2'  id='td_accName_471'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_471'></td>
							<td class='th4'  id='td_relname_471'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_471' value='17'>
						<input type='hidden' name='code_471' value='059100'><tr id='tr_472' onClick="goDetail('059200',472)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_472' id='chk_472' style='height:12px' value='Y' checked></td>
							<td class='th1' >0592</td>
							<td class='th2'  id='td_accName_472'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_472'></td>
							<td class='th4'  id='td_relname_472'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_472' value='17'>
						<input type='hidden' name='code_472' value='059200'><tr id='tr_473' onClick="goDetail('059300',473)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_473' id='chk_473' style='height:12px' value='Y' checked></td>
							<td class='th1' >0593</td>
							<td class='th2'  id='td_accName_473'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_473'></td>
							<td class='th4'  id='td_relname_473'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_473' value='17'>
						<input type='hidden' name='code_473' value='059300'><tr id='tr_474' onClick="goDetail('059400',474)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_474' id='chk_474' style='height:12px' value='Y' checked></td>
							<td class='th1' >0594</td>
							<td class='th2'  id='td_accName_474'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_474'></td>
							<td class='th4'  id='td_relname_474'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_474' value='17'>
						<input type='hidden' name='code_474' value='059400'><tr id='tr_475' onClick="goDetail('059500',475)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_475' id='chk_475' style='height:12px' value='Y' checked></td>
							<td class='th1' >0595</td>
							<td class='th2'  id='td_accName_475'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_475'></td>
							<td class='th4'  id='td_relname_475'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_475' value='17'>
						<input type='hidden' name='code_475' value='059500'><tr id='tr_476' onClick="goDetail('059600',476)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_476' id='chk_476' style='height:12px' value='Y' checked></td>
							<td class='th1' >0596</td>
							<td class='th2'  id='td_accName_476'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_476'></td>
							<td class='th4'  id='td_relname_476'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_476' value='17'>
						<input type='hidden' name='code_476' value='059600'><tr id='tr_477' onClick="goDetail('059700',477)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_477' id='chk_477' style='height:12px' value='Y' checked></td>
							<td class='th1' >0597</td>
							<td class='th2'  id='td_accName_477'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_477'></td>
							<td class='th4'  id='td_relname_477'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_477' value='17'>
						<input type='hidden' name='code_477' value='059700'><tr id='tr_478' onClick="goDetail('059800',478)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_478' id='chk_478' style='height:12px' value='Y' checked></td>
							<td class='th1' >0598</td>
							<td class='th2'  id='td_accName_478'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_478'></td>
							<td class='th4'  id='td_relname_478'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_478' value='17'>
						<input type='hidden' name='code_478' value='059800'><tr id='tr_479' onClick="goDetail('059900',479)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_479' id='chk_479' style='height:12px' value='Y' checked></td>
							<td class='th1' >0599</td>
							<td class='th2'  id='td_accName_479'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_479'></td>
							<td class='th4'  id='td_relname_479'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_479' value='17'>
						<input type='hidden' name='code_479' value='059900'><tr id='tr_480' onClick="goDetail('060000',480)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_480' id='chk_480' style='height:12px' value='Y' checked></td>
							<td class='th1' >0600</td>
							<td class='th2'  id='td_accName_480'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_480'></td>
							<td class='th4'  id='td_relname_480'>제조원가</td>
						</tr>
						<input type='hidden' id='Scode_480' value='17'>
						<input type='hidden' name='code_480' value='060000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_18' id='S_18' style='height:12px' value='Y' onClick="chk_Scode('18')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='18'>도급원가</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_481' onClick="goDetail('060100',481)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_481' id='chk_481' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0601</td>
							<td class='th2' style='color:#ec4261' id='td_accName_481'>원재료비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_481'>1.원재료비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_481'>원재료(도급)</td>
						</tr>
						<input type='hidden' id='Scode_481' value='18'>
						<input type='hidden' name='code_481' value='060100'><tr id='tr_482' onClick="goDetail('060200',482)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_482' id='chk_482' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0602</td>
							<td class='th2' style='color:#ec4261' id='td_accName_482'>외주비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_482'>6.항목(집계)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_482'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_482' value='18'>
						<input type='hidden' name='code_482' value='060200'><tr id='tr_483' onClick="goDetail('060300',483)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_483' id='chk_483' style='height:12px' value='Y' checked></td>
							<td class='th1' >0603</td>
							<td class='th2'  id='td_accName_483'>잡급 </td>
							<td class='th3'  id='td_chr_483'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_483'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_483' value='18'>
						<input type='hidden' name='code_483' value='060300'><tr id='tr_484' onClick="goDetail('060400',484)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_484' id='chk_484' style='height:12px' value='Y' checked></td>
							<td class='th1' >0604</td>
							<td class='th2'  id='td_accName_484'>임금 </td>
							<td class='th3'  id='td_chr_484'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_484'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_484' value='18'>
						<input type='hidden' name='code_484' value='060400'><tr id='tr_485' onClick="goDetail('060500',485)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_485' id='chk_485' style='height:12px' value='Y' checked></td>
							<td class='th1' >0605</td>
							<td class='th2'  id='td_accName_485'>상여금 </td>
							<td class='th3'  id='td_chr_485'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_485'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_485' value='18'>
						<input type='hidden' name='code_485' value='060500'><tr id='tr_486' onClick="goDetail('060600',486)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_486' id='chk_486' style='height:12px' value='Y' checked></td>
							<td class='th1' >0606</td>
							<td class='th2'  id='td_accName_486'>제수당 </td>
							<td class='th3'  id='td_chr_486'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_486'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_486' value='18'>
						<input type='hidden' name='code_486' value='060600'><tr id='tr_487' onClick="goDetail('060700',487)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_487' id='chk_487' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0607</td>
							<td class='th2' style='color:#ec4261' id='td_accName_487'>퇴직급여 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_487'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_487'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_487' value='18'>
						<input type='hidden' name='code_487' value='060700'><tr id='tr_488' onClick="goDetail('060800',488)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_488' id='chk_488' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0608</td>
							<td class='th2' style='color:#ec4261' id='td_accName_488'>퇴직보험충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_488'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_488'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_488' value='18'>
						<input type='hidden' name='code_488' value='060800'><tr id='tr_489' onClick="goDetail('060900',489)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_489' id='chk_489' style='height:12px' value='Y' checked></td>
							<td class='th1' >0609</td>
							<td class='th2'  id='td_accName_489'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_489'>5.도급경비</td>
							<td class='th4'  id='td_relname_489'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_489' value='18'>
						<input type='hidden' name='code_489' value='060900'><tr id='tr_490' onClick="goDetail('061000',490)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_490' id='chk_490' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0610</td>
							<td class='th2' style='color:#ec4261' id='td_accName_490'>중기및운반비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_490'>6.항목(집계)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_490'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_490' value='18'>
						<input type='hidden' name='code_490' value='061000'><tr id='tr_491' onClick="goDetail('061100',491)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_491' id='chk_491' style='height:12px' value='Y' checked></td>
							<td class='th1' >0611</td>
							<td class='th2'  id='td_accName_491'>복리후생비 </td>
							<td class='th3'  id='td_chr_491'>5.도급경비</td>
							<td class='th4'  id='td_relname_491'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_491' value='18'>
						<input type='hidden' name='code_491' value='061100'><tr id='tr_492' onClick="goDetail('061200',492)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_492' id='chk_492' style='height:12px' value='Y' checked></td>
							<td class='th1' >0612</td>
							<td class='th2'  id='td_accName_492'>여비교통비 </td>
							<td class='th3'  id='td_chr_492'>5.도급경비</td>
							<td class='th4'  id='td_relname_492'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_492' value='18'>
						<input type='hidden' name='code_492' value='061200'><tr id='tr_493' onClick="goDetail('061300',493)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_493' id='chk_493' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0613</td>
							<td class='th2' style='color:#ec4261' id='td_accName_493'>접대비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_493'>5.도급경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_493'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_493' value='18'>
						<input type='hidden' name='code_493' value='061300'><tr id='tr_494' onClick="goDetail('061400',494)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_494' id='chk_494' style='height:12px' value='Y' checked></td>
							<td class='th1' >0614</td>
							<td class='th2'  id='td_accName_494'>통신비 </td>
							<td class='th3'  id='td_chr_494'>5.도급경비</td>
							<td class='th4'  id='td_relname_494'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_494' value='18'>
						<input type='hidden' name='code_494' value='061400'><tr id='tr_495' onClick="goDetail('061500',495)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_495' id='chk_495' style='height:12px' value='Y' checked></td>
							<td class='th1' >0615</td>
							<td class='th2'  id='td_accName_495'>가스수도료 </td>
							<td class='th3'  id='td_chr_495'>5.도급경비</td>
							<td class='th4'  id='td_relname_495'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_495' value='18'>
						<input type='hidden' name='code_495' value='061500'><tr id='tr_496' onClick="goDetail('061600',496)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_496' id='chk_496' style='height:12px' value='Y' checked></td>
							<td class='th1' >0616</td>
							<td class='th2'  id='td_accName_496'>전력비 </td>
							<td class='th3'  id='td_chr_496'>5.도급경비</td>
							<td class='th4'  id='td_relname_496'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_496' value='18'>
						<input type='hidden' name='code_496' value='061600'><tr id='tr_497' onClick="goDetail('061700',497)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_497' id='chk_497' style='height:12px' value='Y' checked></td>
							<td class='th1' >0617</td>
							<td class='th2'  id='td_accName_497'>세금과공과금 </td>
							<td class='th3'  id='td_chr_497'>5.도급경비</td>
							<td class='th4'  id='td_relname_497'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_497' value='18'>
						<input type='hidden' name='code_497' value='061700'><tr id='tr_498' onClick="goDetail('061800',498)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_498' id='chk_498' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0618</td>
							<td class='th2' style='color:#ec4261' id='td_accName_498'>감가상각비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_498'>5.도급경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_498'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_498' value='18'>
						<input type='hidden' name='code_498' value='061800'><tr id='tr_499' onClick="goDetail('061900',499)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_499' id='chk_499' style='height:12px' value='Y' checked></td>
							<td class='th1' >0619</td>
							<td class='th2'  id='td_accName_499'>임차료 </td>
							<td class='th3'  id='td_chr_499'>5.도급경비</td>
							<td class='th4'  id='td_relname_499'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_499' value='18'>
						<input type='hidden' name='code_499' value='061900'><tr id='tr_500' onClick="goDetail('062000',500)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_500' id='chk_500' style='height:12px' value='Y' checked></td>
							<td class='th1' >0620</td>
							<td class='th2'  id='td_accName_500'>수선비 </td>
							<td class='th3'  id='td_chr_500'>5.도급경비</td>
							<td class='th4'  id='td_relname_500'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_500' value='18'>
						<input type='hidden' name='code_500' value='062000'><tr id='tr_501' onClick="goDetail('062100',501)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_501' id='chk_501' style='height:12px' value='Y' checked></td>
							<td class='th1' >0621</td>
							<td class='th2'  id='td_accName_501'>보험료 </td>
							<td class='th3'  id='td_chr_501'>5.도급경비</td>
							<td class='th4'  id='td_relname_501'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_501' value='18'>
						<input type='hidden' name='code_501' value='062100'><tr id='tr_502' onClick="goDetail('062200',502)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_502' id='chk_502' style='height:12px' value='Y' checked></td>
							<td class='th1' >0622</td>
							<td class='th2'  id='td_accName_502'>차량유지비 </td>
							<td class='th3'  id='td_chr_502'>5.도급경비</td>
							<td class='th4'  id='td_relname_502'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_502' value='18'>
						<input type='hidden' name='code_502' value='062200'><tr id='tr_503' onClick="goDetail('062300',503)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_503' id='chk_503' style='height:12px' value='Y' checked></td>
							<td class='th1' >0623</td>
							<td class='th2'  id='td_accName_503'>운반비 </td>
							<td class='th3'  id='td_chr_503'>5.도급경비</td>
							<td class='th4'  id='td_relname_503'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_503' value='18'>
						<input type='hidden' name='code_503' value='062300'><tr id='tr_504' onClick="goDetail('062400',504)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_504' id='chk_504' style='height:12px' value='Y' checked></td>
							<td class='th1' >0624</td>
							<td class='th2'  id='td_accName_504'>잡자재대 </td>
							<td class='th3'  id='td_chr_504'>5.도급경비</td>
							<td class='th4'  id='td_relname_504'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_504' value='18'>
						<input type='hidden' name='code_504' value='062400'><tr id='tr_505' onClick="goDetail('062500',505)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_505' id='chk_505' style='height:12px' value='Y' checked></td>
							<td class='th1' >0625</td>
							<td class='th2'  id='td_accName_505'>교육훈련비 </td>
							<td class='th3'  id='td_chr_505'>5.도급경비</td>
							<td class='th4'  id='td_relname_505'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_505' value='18'>
						<input type='hidden' name='code_505' value='062500'><tr id='tr_506' onClick="goDetail('062600',506)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_506' id='chk_506' style='height:12px' value='Y' checked></td>
							<td class='th1' >0626</td>
							<td class='th2'  id='td_accName_506'>도서인쇄비 </td>
							<td class='th3'  id='td_chr_506'>5.도급경비</td>
							<td class='th4'  id='td_relname_506'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_506' value='18'>
						<input type='hidden' name='code_506' value='062600'><tr id='tr_507' onClick="goDetail('062700',507)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_507' id='chk_507' style='height:12px' value='Y' checked></td>
							<td class='th1' >0627</td>
							<td class='th2'  id='td_accName_507'>하자보수비 </td>
							<td class='th3'  id='td_chr_507'>5.도급경비</td>
							<td class='th4'  id='td_relname_507'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_507' value='18'>
						<input type='hidden' name='code_507' value='062700'><tr id='tr_508' onClick="goDetail('062800',508)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_508' id='chk_508' style='height:12px' value='Y' checked></td>
							<td class='th1' >0628</td>
							<td class='th2'  id='td_accName_508'>포장비 </td>
							<td class='th3'  id='td_chr_508'>5.도급경비</td>
							<td class='th4'  id='td_relname_508'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_508' value='18'>
						<input type='hidden' name='code_508' value='062800'><tr id='tr_509' onClick="goDetail('062900',509)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_509' id='chk_509' style='height:12px' value='Y' checked></td>
							<td class='th1' >0629</td>
							<td class='th2'  id='td_accName_509'>사무용품비 </td>
							<td class='th3'  id='td_chr_509'>5.도급경비</td>
							<td class='th4'  id='td_relname_509'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_509' value='18'>
						<input type='hidden' name='code_509' value='062900'><tr id='tr_510' onClick="goDetail('063000',510)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_510' id='chk_510' style='height:12px' value='Y' checked></td>
							<td class='th1' >0630</td>
							<td class='th2'  id='td_accName_510'>소모품비 </td>
							<td class='th3'  id='td_chr_510'>5.도급경비</td>
							<td class='th4'  id='td_relname_510'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_510' value='18'>
						<input type='hidden' name='code_510' value='063000'><tr id='tr_511' onClick="goDetail('063100',511)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_511' id='chk_511' style='height:12px' value='Y' checked></td>
							<td class='th1' >0631</td>
							<td class='th2'  id='td_accName_511'>지급수수료 </td>
							<td class='th3'  id='td_chr_511'>5.도급경비</td>
							<td class='th4'  id='td_relname_511'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_511' value='18'>
						<input type='hidden' name='code_511' value='063100'><tr id='tr_512' onClick="goDetail('063200',512)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_512' id='chk_512' style='height:12px' value='Y' checked></td>
							<td class='th1' >0632</td>
							<td class='th2'  id='td_accName_512'>보관료 </td>
							<td class='th3'  id='td_chr_512'>5.도급경비</td>
							<td class='th4'  id='td_relname_512'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_512' value='18'>
						<input type='hidden' name='code_512' value='063200'><tr id='tr_513' onClick="goDetail('063300',513)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_513' id='chk_513' style='height:12px' value='Y' checked></td>
							<td class='th1' >0633</td>
							<td class='th2'  id='td_accName_513'>외주가공비 </td>
							<td class='th3'  id='td_chr_513'>5.도급경비</td>
							<td class='th4'  id='td_relname_513'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_513' value='18'>
						<input type='hidden' name='code_513' value='063300'><tr id='tr_514' onClick="goDetail('063400',514)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_514' id='chk_514' style='height:12px' value='Y' checked></td>
							<td class='th1' >0634</td>
							<td class='th2'  id='td_accName_514'>장비사용료 </td>
							<td class='th3'  id='td_chr_514'>5.도급경비</td>
							<td class='th4'  id='td_relname_514'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_514' value='18'>
						<input type='hidden' name='code_514' value='063400'><tr id='tr_515' onClick="goDetail('063500',515)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_515' id='chk_515' style='height:12px' value='Y' checked></td>
							<td class='th1' >0635</td>
							<td class='th2'  id='td_accName_515'>설계용역비 </td>
							<td class='th3'  id='td_chr_515'>5.도급경비</td>
							<td class='th4'  id='td_relname_515'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_515' value='18'>
						<input type='hidden' name='code_515' value='063500'><tr id='tr_516' onClick="goDetail('063600',516)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_516' id='chk_516' style='height:12px' value='Y' checked></td>
							<td class='th1' >0636</td>
							<td class='th2'  id='td_accName_516'>광고선전비 </td>
							<td class='th3'  id='td_chr_516'>5.도급경비</td>
							<td class='th4'  id='td_relname_516'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_516' value='18'>
						<input type='hidden' name='code_516' value='063600'><tr id='tr_517' onClick="goDetail('063700',517)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_517' id='chk_517' style='height:12px' value='Y' checked></td>
							<td class='th1' >0637</td>
							<td class='th2'  id='td_accName_517'>소모공구비 </td>
							<td class='th3'  id='td_chr_517'>5.도급경비</td>
							<td class='th4'  id='td_relname_517'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_517' value='18'>
						<input type='hidden' name='code_517' value='063700'><tr id='tr_518' onClick="goDetail('063800',518)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_518' id='chk_518' style='height:12px' value='Y' checked></td>
							<td class='th1' >0638</td>
							<td class='th2'  id='td_accName_518'>외주공사비 </td>
							<td class='th3'  id='td_chr_518'>5.도급경비</td>
							<td class='th4'  id='td_relname_518'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_518' value='18'>
						<input type='hidden' name='code_518' value='063800'><tr id='tr_519' onClick="goDetail('063900',519)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_519' id='chk_519' style='height:12px' value='Y' checked></td>
							<td class='th1' >0639</td>
							<td class='th2'  id='td_accName_519'>협회비 </td>
							<td class='th3'  id='td_chr_519'>5.도급경비</td>
							<td class='th4'  id='td_relname_519'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_519' value='18'>
						<input type='hidden' name='code_519' value='063900'><tr id='tr_520' onClick="goDetail('064000',520)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_520' id='chk_520' style='height:12px' value='Y' checked></td>
							<td class='th1' >0640</td>
							<td class='th2'  id='td_accName_520'>잡비 </td>
							<td class='th3'  id='td_chr_520'>5.도급경비</td>
							<td class='th4'  id='td_relname_520'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_520' value='18'>
						<input type='hidden' name='code_520' value='064000'><tr id='tr_521' onClick="goDetail('064100',521)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_521' id='chk_521' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0641</td>
							<td class='th2' style='color:#ec4261' id='td_accName_521'>공사손실충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_521'>6.항목(집계)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_521'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_521' value='18'>
						<input type='hidden' name='code_521' value='064100'><tr id='tr_522' onClick="goDetail('064200',522)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_522' id='chk_522' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0642</td>
							<td class='th2' style='color:#ec4261' id='td_accName_522'>공사손실충당금환입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_522'>6.항목(집계)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_522'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_522' value='18'>
						<input type='hidden' name='code_522' value='064200'><tr id='tr_523' onClick="goDetail('064300',523)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_523' id='chk_523' style='height:12px' value='Y' checked></td>
							<td class='th1' >0643</td>
							<td class='th2'  id='td_accName_523'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_523'>5.도급경비</td>
							<td class='th4'  id='td_relname_523'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_523' value='18'>
						<input type='hidden' name='code_523' value='064300'><tr id='tr_524' onClick="goDetail('064400',524)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_524' id='chk_524' style='height:12px' value='Y' checked></td>
							<td class='th1' >0644</td>
							<td class='th2'  id='td_accName_524'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_524'>5.도급경비</td>
							<td class='th4'  id='td_relname_524'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_524' value='18'>
						<input type='hidden' name='code_524' value='064400'><tr id='tr_525' onClick="goDetail('064500',525)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_525' id='chk_525' style='height:12px' value='Y' checked></td>
							<td class='th1' >0645</td>
							<td class='th2'  id='td_accName_525'>소모재료비 </td>
							<td class='th3'  id='td_chr_525'>5.도급경비</td>
							<td class='th4'  id='td_relname_525'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_525' value='18'>
						<input type='hidden' name='code_525' value='064500'><tr id='tr_526' onClick="goDetail('064600',526)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_526' id='chk_526' style='height:12px' value='Y' checked></td>
							<td class='th1' >0646</td>
							<td class='th2'  id='td_accName_526'>소모공구비 </td>
							<td class='th3'  id='td_chr_526'>5.도급경비</td>
							<td class='th4'  id='td_relname_526'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_526' value='18'>
						<input type='hidden' name='code_526' value='064600'><tr id='tr_527' onClick="goDetail('064700',527)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_527' id='chk_527' style='height:12px' value='Y' checked></td>
							<td class='th1' >0647</td>
							<td class='th2'  id='td_accName_527'>임차료 </td>
							<td class='th3'  id='td_chr_527'>5.도급경비</td>
							<td class='th4'  id='td_relname_527'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_527' value='18'>
						<input type='hidden' name='code_527' value='064700'><tr id='tr_528' onClick="goDetail('064800',528)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_528' id='chk_528' style='height:12px' value='Y' checked></td>
							<td class='th1' >0648</td>
							<td class='th2'  id='td_accName_528'>중기임차료 </td>
							<td class='th3'  id='td_chr_528'>5.도급경비</td>
							<td class='th4'  id='td_relname_528'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_528' value='18'>
						<input type='hidden' name='code_528' value='064800'><tr id='tr_529' onClick="goDetail('064900',529)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_529' id='chk_529' style='height:12px' value='Y' checked></td>
							<td class='th1' >0649</td>
							<td class='th2'  id='td_accName_529'>명예퇴직금 </td>
							<td class='th3'  id='td_chr_529'>4.노무비(퇴직)</td>
							<td class='th4'  id='td_relname_529'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_529' value='18'>
						<input type='hidden' name='code_529' value='064900'><tr id='tr_530' onClick="goDetail('065000',530)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_530' id='chk_530' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0650</td>
							<td class='th2' style='color:#ec4261' id='td_accName_530'>퇴직연금충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_530'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_530'>도급원가</td>
						</tr>
						<input type='hidden' id='Scode_530' value='18'>
						<input type='hidden' name='code_530' value='065000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_19' id='S_19' style='height:12px' value='Y' onClick="chk_Scode('19')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='19'>보관원가</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_531' onClick="goDetail('065100',531)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_531' id='chk_531' style='height:12px' value='Y' checked></td>
							<td class='th1' >0651</td>
							<td class='th2'  id='td_accName_531'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_531'></td>
							<td class='th4'  id='td_relname_531'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_531' value='19'>
						<input type='hidden' name='code_531' value='065100'><tr id='tr_532' onClick="goDetail('065200',532)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_532' id='chk_532' style='height:12px' value='Y' checked></td>
							<td class='th1' >0652</td>
							<td class='th2'  id='td_accName_532'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_532'></td>
							<td class='th4'  id='td_relname_532'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_532' value='19'>
						<input type='hidden' name='code_532' value='065200'><tr id='tr_533' onClick="goDetail('065300',533)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_533' id='chk_533' style='height:12px' value='Y' checked></td>
							<td class='th1' >0653</td>
							<td class='th2'  id='td_accName_533'>급여 </td>
							<td class='th3'  id='td_chr_533'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_533'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_533' value='19'>
						<input type='hidden' name='code_533' value='065300'><tr id='tr_534' onClick="goDetail('065400',534)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_534' id='chk_534' style='height:12px' value='Y' checked></td>
							<td class='th1' >0654</td>
							<td class='th2'  id='td_accName_534'>임금 </td>
							<td class='th3'  id='td_chr_534'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_534'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_534' value='19'>
						<input type='hidden' name='code_534' value='065400'><tr id='tr_535' onClick="goDetail('065500',535)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_535' id='chk_535' style='height:12px' value='Y' checked></td>
							<td class='th1' >0655</td>
							<td class='th2'  id='td_accName_535'>상여금 </td>
							<td class='th3'  id='td_chr_535'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_535'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_535' value='19'>
						<input type='hidden' name='code_535' value='065500'><tr id='tr_536' onClick="goDetail('065600',536)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_536' id='chk_536' style='height:12px' value='Y' checked></td>
							<td class='th1' >0656</td>
							<td class='th2'  id='td_accName_536'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_536'></td>
							<td class='th4'  id='td_relname_536'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_536' value='19'>
						<input type='hidden' name='code_536' value='065600'><tr id='tr_537' onClick="goDetail('065700',537)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_537' id='chk_537' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0657</td>
							<td class='th2' style='color:#ec4261' id='td_accName_537'>퇴직급여 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_537'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_537'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_537' value='19'>
						<input type='hidden' name='code_537' value='065700'><tr id='tr_538' onClick="goDetail('065800',538)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_538' id='chk_538' style='height:12px' value='Y' checked></td>
							<td class='th1' >0658</td>
							<td class='th2'  id='td_accName_538'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_538'></td>
							<td class='th4'  id='td_relname_538'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_538' value='19'>
						<input type='hidden' name='code_538' value='065800'><tr id='tr_539' onClick="goDetail('065900',539)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_539' id='chk_539' style='height:12px' value='Y' checked></td>
							<td class='th1' >0659</td>
							<td class='th2'  id='td_accName_539'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_539'></td>
							<td class='th4'  id='td_relname_539'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_539' value='19'>
						<input type='hidden' name='code_539' value='065900'><tr id='tr_540' onClick="goDetail('066000',540)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_540' id='chk_540' style='height:12px' value='Y' checked></td>
							<td class='th1' >0660</td>
							<td class='th2'  id='td_accName_540'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_540'></td>
							<td class='th4'  id='td_relname_540'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_540' value='19'>
						<input type='hidden' name='code_540' value='066000'><tr id='tr_541' onClick="goDetail('066100',541)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_541' id='chk_541' style='height:12px' value='Y' checked></td>
							<td class='th1' >0661</td>
							<td class='th2'  id='td_accName_541'>복리후생비 </td>
							<td class='th3'  id='td_chr_541'>5.보관경비</td>
							<td class='th4'  id='td_relname_541'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_541' value='19'>
						<input type='hidden' name='code_541' value='066100'><tr id='tr_542' onClick="goDetail('066200',542)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_542' id='chk_542' style='height:12px' value='Y' checked></td>
							<td class='th1' >0662</td>
							<td class='th2'  id='td_accName_542'>여비교통비 </td>
							<td class='th3'  id='td_chr_542'>5.보관경비</td>
							<td class='th4'  id='td_relname_542'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_542' value='19'>
						<input type='hidden' name='code_542' value='066200'><tr id='tr_543' onClick="goDetail('066300',543)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_543' id='chk_543' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0663</td>
							<td class='th2' style='color:#ec4261' id='td_accName_543'>접대비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_543'>5.보관경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_543'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_543' value='19'>
						<input type='hidden' name='code_543' value='066300'><tr id='tr_544' onClick="goDetail('066400',544)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_544' id='chk_544' style='height:12px' value='Y' checked></td>
							<td class='th1' >0664</td>
							<td class='th2'  id='td_accName_544'>통신비 </td>
							<td class='th3'  id='td_chr_544'>5.보관경비</td>
							<td class='th4'  id='td_relname_544'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_544' value='19'>
						<input type='hidden' name='code_544' value='066400'><tr id='tr_545' onClick="goDetail('066500',545)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_545' id='chk_545' style='height:12px' value='Y' checked></td>
							<td class='th1' >0665</td>
							<td class='th2'  id='td_accName_545'>가스수도료 </td>
							<td class='th3'  id='td_chr_545'>5.보관경비</td>
							<td class='th4'  id='td_relname_545'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_545' value='19'>
						<input type='hidden' name='code_545' value='066500'><tr id='tr_546' onClick="goDetail('066600',546)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_546' id='chk_546' style='height:12px' value='Y' checked></td>
							<td class='th1' >0666</td>
							<td class='th2'  id='td_accName_546'>전력비 </td>
							<td class='th3'  id='td_chr_546'>5.보관경비</td>
							<td class='th4'  id='td_relname_546'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_546' value='19'>
						<input type='hidden' name='code_546' value='066600'><tr id='tr_547' onClick="goDetail('066700',547)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_547' id='chk_547' style='height:12px' value='Y' checked></td>
							<td class='th1' >0667</td>
							<td class='th2'  id='td_accName_547'>세금과공과금 </td>
							<td class='th3'  id='td_chr_547'>5.보관경비</td>
							<td class='th4'  id='td_relname_547'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_547' value='19'>
						<input type='hidden' name='code_547' value='066700'><tr id='tr_548' onClick="goDetail('066800',548)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_548' id='chk_548' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0668</td>
							<td class='th2' style='color:#ec4261' id='td_accName_548'>감가상각비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_548'>5.보관경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_548'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_548' value='19'>
						<input type='hidden' name='code_548' value='066800'><tr id='tr_549' onClick="goDetail('066900',549)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_549' id='chk_549' style='height:12px' value='Y' checked></td>
							<td class='th1' >0669</td>
							<td class='th2'  id='td_accName_549'>임차료 </td>
							<td class='th3'  id='td_chr_549'>5.보관경비</td>
							<td class='th4'  id='td_relname_549'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_549' value='19'>
						<input type='hidden' name='code_549' value='066900'><tr id='tr_550' onClick="goDetail('067000',550)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_550' id='chk_550' style='height:12px' value='Y' checked></td>
							<td class='th1' >0670</td>
							<td class='th2'  id='td_accName_550'>수선비 </td>
							<td class='th3'  id='td_chr_550'>5.보관경비</td>
							<td class='th4'  id='td_relname_550'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_550' value='19'>
						<input type='hidden' name='code_550' value='067000'><tr id='tr_551' onClick="goDetail('067100',551)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_551' id='chk_551' style='height:12px' value='Y' checked></td>
							<td class='th1' >0671</td>
							<td class='th2'  id='td_accName_551'>보험료 </td>
							<td class='th3'  id='td_chr_551'>5.보관경비</td>
							<td class='th4'  id='td_relname_551'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_551' value='19'>
						<input type='hidden' name='code_551' value='067100'><tr id='tr_552' onClick="goDetail('067200',552)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_552' id='chk_552' style='height:12px' value='Y' checked></td>
							<td class='th1' >0672</td>
							<td class='th2'  id='td_accName_552'>차량유지비 </td>
							<td class='th3'  id='td_chr_552'>5.보관경비</td>
							<td class='th4'  id='td_relname_552'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_552' value='19'>
						<input type='hidden' name='code_552' value='067200'><tr id='tr_553' onClick="goDetail('067300',553)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_553' id='chk_553' style='height:12px' value='Y' checked></td>
							<td class='th1' >0673</td>
							<td class='th2'  id='td_accName_553'>운반비 </td>
							<td class='th3'  id='td_chr_553'>5.보관경비</td>
							<td class='th4'  id='td_relname_553'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_553' value='19'>
						<input type='hidden' name='code_553' value='067300'><tr id='tr_554' onClick="goDetail('067400',554)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_554' id='chk_554' style='height:12px' value='Y' checked></td>
							<td class='th1' >0674</td>
							<td class='th2'  id='td_accName_554'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_554'>5.보관경비</td>
							<td class='th4'  id='td_relname_554'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_554' value='19'>
						<input type='hidden' name='code_554' value='067400'><tr id='tr_555' onClick="goDetail('067500',555)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_555' id='chk_555' style='height:12px' value='Y' checked></td>
							<td class='th1' >0675</td>
							<td class='th2'  id='td_accName_555'>교육훈련비 </td>
							<td class='th3'  id='td_chr_555'>5.보관경비</td>
							<td class='th4'  id='td_relname_555'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_555' value='19'>
						<input type='hidden' name='code_555' value='067500'><tr id='tr_556' onClick="goDetail('067600',556)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_556' id='chk_556' style='height:12px' value='Y' checked></td>
							<td class='th1' >0676</td>
							<td class='th2'  id='td_accName_556'>도서인쇄비 </td>
							<td class='th3'  id='td_chr_556'>5.보관경비</td>
							<td class='th4'  id='td_relname_556'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_556' value='19'>
						<input type='hidden' name='code_556' value='067600'><tr id='tr_557' onClick="goDetail('067700',557)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_557' id='chk_557' style='height:12px' value='Y' checked></td>
							<td class='th1' >0677</td>
							<td class='th2'  id='td_accName_557'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_557'></td>
							<td class='th4'  id='td_relname_557'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_557' value='19'>
						<input type='hidden' name='code_557' value='067700'><tr id='tr_558' onClick="goDetail('067800',558)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_558' id='chk_558' style='height:12px' value='Y' checked></td>
							<td class='th1' >0678</td>
							<td class='th2'  id='td_accName_558'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_558'></td>
							<td class='th4'  id='td_relname_558'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_558' value='19'>
						<input type='hidden' name='code_558' value='067800'><tr id='tr_559' onClick="goDetail('067900',559)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_559' id='chk_559' style='height:12px' value='Y' checked></td>
							<td class='th1' >0679</td>
							<td class='th2'  id='td_accName_559'>사무용품비 </td>
							<td class='th3'  id='td_chr_559'>5.보관경비</td>
							<td class='th4'  id='td_relname_559'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_559' value='19'>
						<input type='hidden' name='code_559' value='067900'><tr id='tr_560' onClick="goDetail('068000',560)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_560' id='chk_560' style='height:12px' value='Y' checked></td>
							<td class='th1' >0680</td>
							<td class='th2'  id='td_accName_560'>소모품비 </td>
							<td class='th3'  id='td_chr_560'>5.보관경비</td>
							<td class='th4'  id='td_relname_560'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_560' value='19'>
						<input type='hidden' name='code_560' value='068000'><tr id='tr_561' onClick="goDetail('068100',561)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_561' id='chk_561' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0681</td>
							<td class='th2' style='color:#ec4261' id='td_accName_561'>퇴직연금충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_561'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_561'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_561' value='19'>
						<input type='hidden' name='code_561' value='068100'><tr id='tr_562' onClick="goDetail('068200',562)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_562' id='chk_562' style='height:12px' value='Y' checked></td>
							<td class='th1' >0682</td>
							<td class='th2'  id='td_accName_562'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_562'></td>
							<td class='th4'  id='td_relname_562'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_562' value='19'>
						<input type='hidden' name='code_562' value='068200'><tr id='tr_563' onClick="goDetail('068300',563)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_563' id='chk_563' style='height:12px' value='Y' checked></td>
							<td class='th1' >0683</td>
							<td class='th2'  id='td_accName_563'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_563'></td>
							<td class='th4'  id='td_relname_563'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_563' value='19'>
						<input type='hidden' name='code_563' value='068300'><tr id='tr_564' onClick="goDetail('068400',564)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_564' id='chk_564' style='height:12px' value='Y' checked></td>
							<td class='th1' >0684</td>
							<td class='th2'  id='td_accName_564'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_564'></td>
							<td class='th4'  id='td_relname_564'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_564' value='19'>
						<input type='hidden' name='code_564' value='068400'><tr id='tr_565' onClick="goDetail('068500',565)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_565' id='chk_565' style='height:12px' value='Y' checked></td>
							<td class='th1' >0685</td>
							<td class='th2'  id='td_accName_565'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_565'></td>
							<td class='th4'  id='td_relname_565'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_565' value='19'>
						<input type='hidden' name='code_565' value='068500'><tr id='tr_566' onClick="goDetail('068600',566)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_566' id='chk_566' style='height:12px' value='Y' checked></td>
							<td class='th1' >0686</td>
							<td class='th2'  id='td_accName_566'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_566'></td>
							<td class='th4'  id='td_relname_566'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_566' value='19'>
						<input type='hidden' name='code_566' value='068600'><tr id='tr_567' onClick="goDetail('068700',567)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_567' id='chk_567' style='height:12px' value='Y' checked></td>
							<td class='th1' >0687</td>
							<td class='th2'  id='td_accName_567'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_567'></td>
							<td class='th4'  id='td_relname_567'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_567' value='19'>
						<input type='hidden' name='code_567' value='068700'><tr id='tr_568' onClick="goDetail('068800',568)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_568' id='chk_568' style='height:12px' value='Y' checked></td>
							<td class='th1' >0688</td>
							<td class='th2'  id='td_accName_568'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_568'></td>
							<td class='th4'  id='td_relname_568'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_568' value='19'>
						<input type='hidden' name='code_568' value='068800'><tr id='tr_569' onClick="goDetail('068900',569)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_569' id='chk_569' style='height:12px' value='Y' checked></td>
							<td class='th1' >0689</td>
							<td class='th2'  id='td_accName_569'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_569'></td>
							<td class='th4'  id='td_relname_569'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_569' value='19'>
						<input type='hidden' name='code_569' value='068900'><tr id='tr_570' onClick="goDetail('069000',570)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_570' id='chk_570' style='height:12px' value='Y' checked></td>
							<td class='th1' >0690</td>
							<td class='th2'  id='td_accName_570'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_570'></td>
							<td class='th4'  id='td_relname_570'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_570' value='19'>
						<input type='hidden' name='code_570' value='069000'><tr id='tr_571' onClick="goDetail('069100',571)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_571' id='chk_571' style='height:12px' value='Y' checked></td>
							<td class='th1' >0691</td>
							<td class='th2'  id='td_accName_571'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_571'></td>
							<td class='th4'  id='td_relname_571'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_571' value='19'>
						<input type='hidden' name='code_571' value='069100'><tr id='tr_572' onClick="goDetail('069200',572)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_572' id='chk_572' style='height:12px' value='Y' checked></td>
							<td class='th1' >0692</td>
							<td class='th2'  id='td_accName_572'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_572'></td>
							<td class='th4'  id='td_relname_572'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_572' value='19'>
						<input type='hidden' name='code_572' value='069200'><tr id='tr_573' onClick="goDetail('069300',573)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_573' id='chk_573' style='height:12px' value='Y' checked></td>
							<td class='th1' >0693</td>
							<td class='th2'  id='td_accName_573'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_573'></td>
							<td class='th4'  id='td_relname_573'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_573' value='19'>
						<input type='hidden' name='code_573' value='069300'><tr id='tr_574' onClick="goDetail('069400',574)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_574' id='chk_574' style='height:12px' value='Y' checked></td>
							<td class='th1' >0694</td>
							<td class='th2'  id='td_accName_574'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_574'></td>
							<td class='th4'  id='td_relname_574'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_574' value='19'>
						<input type='hidden' name='code_574' value='069400'><tr id='tr_575' onClick="goDetail('069500',575)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_575' id='chk_575' style='height:12px' value='Y' checked></td>
							<td class='th1' >0695</td>
							<td class='th2'  id='td_accName_575'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_575'></td>
							<td class='th4'  id='td_relname_575'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_575' value='19'>
						<input type='hidden' name='code_575' value='069500'><tr id='tr_576' onClick="goDetail('069600',576)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_576' id='chk_576' style='height:12px' value='Y' checked></td>
							<td class='th1' >0696</td>
							<td class='th2'  id='td_accName_576'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_576'></td>
							<td class='th4'  id='td_relname_576'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_576' value='19'>
						<input type='hidden' name='code_576' value='069600'><tr id='tr_577' onClick="goDetail('069700',577)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_577' id='chk_577' style='height:12px' value='Y' checked></td>
							<td class='th1' >0697</td>
							<td class='th2'  id='td_accName_577'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_577'></td>
							<td class='th4'  id='td_relname_577'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_577' value='19'>
						<input type='hidden' name='code_577' value='069700'><tr id='tr_578' onClick="goDetail('069800',578)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_578' id='chk_578' style='height:12px' value='Y' checked></td>
							<td class='th1' >0698</td>
							<td class='th2'  id='td_accName_578'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_578'></td>
							<td class='th4'  id='td_relname_578'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_578' value='19'>
						<input type='hidden' name='code_578' value='069800'><tr id='tr_579' onClick="goDetail('069900',579)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_579' id='chk_579' style='height:12px' value='Y' checked></td>
							<td class='th1' >0699</td>
							<td class='th2'  id='td_accName_579'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_579'></td>
							<td class='th4'  id='td_relname_579'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_579' value='19'>
						<input type='hidden' name='code_579' value='069900'><tr id='tr_580' onClick="goDetail('070000',580)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_580' id='chk_580' style='height:12px' value='Y' checked></td>
							<td class='th1' >0700</td>
							<td class='th2'  id='td_accName_580'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_580'></td>
							<td class='th4'  id='td_relname_580'>보관원가</td>
						</tr>
						<input type='hidden' id='Scode_580' value='19'>
						<input type='hidden' name='code_580' value='070000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_20' id='S_20' style='height:12px' value='Y' onClick="chk_Scode('20')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='20'>분양원가</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_581' onClick="goDetail('070100',581)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_581' id='chk_581' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0701</td>
							<td class='th2' style='color:#ec4261' id='td_accName_581'>원재료비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_581'>1.원재료비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_581'>원재료(분양)</td>
						</tr>
						<input type='hidden' id='Scode_581' value='20'>
						<input type='hidden' name='code_581' value='070100'><tr id='tr_582' onClick="goDetail('070200',582)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_582' id='chk_582' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0702</td>
							<td class='th2' style='color:#ec4261' id='td_accName_582'>중기및운반비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_582'>6.항목(집계)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_582'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_582' value='20'>
						<input type='hidden' name='code_582' value='070200'><tr id='tr_583' onClick="goDetail('070300',583)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_583' id='chk_583' style='height:12px' value='Y' checked></td>
							<td class='th1' >0703</td>
							<td class='th2'  id='td_accName_583'>급여 </td>
							<td class='th3'  id='td_chr_583'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_583'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_583' value='20'>
						<input type='hidden' name='code_583' value='070300'><tr id='tr_584' onClick="goDetail('070400',584)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_584' id='chk_584' style='height:12px' value='Y' checked></td>
							<td class='th1' >0704</td>
							<td class='th2'  id='td_accName_584'>임금 </td>
							<td class='th3'  id='td_chr_584'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_584'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_584' value='20'>
						<input type='hidden' name='code_584' value='070400'><tr id='tr_585' onClick="goDetail('070500',585)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_585' id='chk_585' style='height:12px' value='Y' checked></td>
							<td class='th1' >0705</td>
							<td class='th2'  id='td_accName_585'>상여금 </td>
							<td class='th3'  id='td_chr_585'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_585'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_585' value='20'>
						<input type='hidden' name='code_585' value='070500'><tr id='tr_586' onClick="goDetail('070600',586)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_586' id='chk_586' style='height:12px' value='Y' checked></td>
							<td class='th1' >0706</td>
							<td class='th2'  id='td_accName_586'>제수당 </td>
							<td class='th3'  id='td_chr_586'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_586'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_586' value='20'>
						<input type='hidden' name='code_586' value='070600'><tr id='tr_587' onClick="goDetail('070700',587)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_587' id='chk_587' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0707</td>
							<td class='th2' style='color:#ec4261' id='td_accName_587'>퇴직급여 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_587'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_587'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_587' value='20'>
						<input type='hidden' name='code_587' value='070700'><tr id='tr_588' onClick="goDetail('070800',588)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_588' id='chk_588' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0708</td>
							<td class='th2' style='color:#ec4261' id='td_accName_588'>퇴직보험충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_588'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_588'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_588' value='20'>
						<input type='hidden' name='code_588' value='070800'><tr id='tr_589' onClick="goDetail('070900',589)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_589' id='chk_589' style='height:12px' value='Y' checked></td>
							<td class='th1' >0709</td>
							<td class='th2'  id='td_accName_589'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_589'></td>
							<td class='th4'  id='td_relname_589'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_589' value='20'>
						<input type='hidden' name='code_589' value='070900'><tr id='tr_590' onClick="goDetail('071000',590)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_590' id='chk_590' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0710</td>
							<td class='th2' style='color:#ec4261' id='td_accName_590'>건설용지비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_590'>6.항목(집계)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_590'>건설용지</td>
						</tr>
						<input type='hidden' id='Scode_590' value='20'>
						<input type='hidden' name='code_590' value='071000'><tr id='tr_591' onClick="goDetail('071100',591)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_591' id='chk_591' style='height:12px' value='Y' checked></td>
							<td class='th1' >0711</td>
							<td class='th2'  id='td_accName_591'>복리후생비 </td>
							<td class='th3'  id='td_chr_591'>5.분양경비</td>
							<td class='th4'  id='td_relname_591'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_591' value='20'>
						<input type='hidden' name='code_591' value='071100'><tr id='tr_592' onClick="goDetail('071200',592)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_592' id='chk_592' style='height:12px' value='Y' checked></td>
							<td class='th1' >0712</td>
							<td class='th2'  id='td_accName_592'>여비교통비 </td>
							<td class='th3'  id='td_chr_592'>5.분양경비</td>
							<td class='th4'  id='td_relname_592'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_592' value='20'>
						<input type='hidden' name='code_592' value='071200'><tr id='tr_593' onClick="goDetail('071300',593)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_593' id='chk_593' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0713</td>
							<td class='th2' style='color:#ec4261' id='td_accName_593'>접대비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_593'>5.분양경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_593'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_593' value='20'>
						<input type='hidden' name='code_593' value='071300'><tr id='tr_594' onClick="goDetail('071400',594)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_594' id='chk_594' style='height:12px' value='Y' checked></td>
							<td class='th1' >0714</td>
							<td class='th2'  id='td_accName_594'>통신비 </td>
							<td class='th3'  id='td_chr_594'>5.분양경비</td>
							<td class='th4'  id='td_relname_594'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_594' value='20'>
						<input type='hidden' name='code_594' value='071400'><tr id='tr_595' onClick="goDetail('071500',595)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_595' id='chk_595' style='height:12px' value='Y' checked></td>
							<td class='th1' >0715</td>
							<td class='th2'  id='td_accName_595'>가스수도료 </td>
							<td class='th3'  id='td_chr_595'>5.분양경비</td>
							<td class='th4'  id='td_relname_595'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_595' value='20'>
						<input type='hidden' name='code_595' value='071500'><tr id='tr_596' onClick="goDetail('071600',596)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_596' id='chk_596' style='height:12px' value='Y' checked></td>
							<td class='th1' >0716</td>
							<td class='th2'  id='td_accName_596'>전력비 </td>
							<td class='th3'  id='td_chr_596'>5.분양경비</td>
							<td class='th4'  id='td_relname_596'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_596' value='20'>
						<input type='hidden' name='code_596' value='071600'><tr id='tr_597' onClick="goDetail('071700',597)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_597' id='chk_597' style='height:12px' value='Y' checked></td>
							<td class='th1' >0717</td>
							<td class='th2'  id='td_accName_597'>세금과공과금 </td>
							<td class='th3'  id='td_chr_597'>5.분양경비</td>
							<td class='th4'  id='td_relname_597'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_597' value='20'>
						<input type='hidden' name='code_597' value='071700'><tr id='tr_598' onClick="goDetail('071800',598)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_598' id='chk_598' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0718</td>
							<td class='th2' style='color:#ec4261' id='td_accName_598'>감가상각비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_598'>5.분양경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_598'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_598' value='20'>
						<input type='hidden' name='code_598' value='071800'><tr id='tr_599' onClick="goDetail('071900',599)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_599' id='chk_599' style='height:12px' value='Y' checked></td>
							<td class='th1' >0719</td>
							<td class='th2'  id='td_accName_599'>임차료 </td>
							<td class='th3'  id='td_chr_599'>5.분양경비</td>
							<td class='th4'  id='td_relname_599'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_599' value='20'>
						<input type='hidden' name='code_599' value='071900'><tr id='tr_600' onClick="goDetail('072000',600)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_600' id='chk_600' style='height:12px' value='Y' checked></td>
							<td class='th1' >0720</td>
							<td class='th2'  id='td_accName_600'>수선비 </td>
							<td class='th3'  id='td_chr_600'>5.분양경비</td>
							<td class='th4'  id='td_relname_600'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_600' value='20'>
						<input type='hidden' name='code_600' value='072000'><tr id='tr_601' onClick="goDetail('072100',601)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_601' id='chk_601' style='height:12px' value='Y' checked></td>
							<td class='th1' >0721</td>
							<td class='th2'  id='td_accName_601'>보험료 </td>
							<td class='th3'  id='td_chr_601'>5.분양경비</td>
							<td class='th4'  id='td_relname_601'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_601' value='20'>
						<input type='hidden' name='code_601' value='072100'><tr id='tr_602' onClick="goDetail('072200',602)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_602' id='chk_602' style='height:12px' value='Y' checked></td>
							<td class='th1' >0722</td>
							<td class='th2'  id='td_accName_602'>차량유지비 </td>
							<td class='th3'  id='td_chr_602'>5.분양경비</td>
							<td class='th4'  id='td_relname_602'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_602' value='20'>
						<input type='hidden' name='code_602' value='072200'><tr id='tr_603' onClick="goDetail('072300',603)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_603' id='chk_603' style='height:12px' value='Y' checked></td>
							<td class='th1' >0723</td>
							<td class='th2'  id='td_accName_603'>경상연구개발비 </td>
							<td class='th3'  id='td_chr_603'>5.분양경비</td>
							<td class='th4'  id='td_relname_603'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_603' value='20'>
						<input type='hidden' name='code_603' value='072300'><tr id='tr_604' onClick="goDetail('072400',604)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_604' id='chk_604' style='height:12px' value='Y' checked></td>
							<td class='th1' >0724</td>
							<td class='th2'  id='td_accName_604'>잡자재대 </td>
							<td class='th3'  id='td_chr_604'>5.분양경비</td>
							<td class='th4'  id='td_relname_604'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_604' value='20'>
						<input type='hidden' name='code_604' value='072400'><tr id='tr_605' onClick="goDetail('072500',605)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_605' id='chk_605' style='height:12px' value='Y' checked></td>
							<td class='th1' >0725</td>
							<td class='th2'  id='td_accName_605'>교육훈련비 </td>
							<td class='th3'  id='td_chr_605'>5.분양경비</td>
							<td class='th4'  id='td_relname_605'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_605' value='20'>
						<input type='hidden' name='code_605' value='072500'><tr id='tr_606' onClick="goDetail('072600',606)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_606' id='chk_606' style='height:12px' value='Y' checked></td>
							<td class='th1' >0726</td>
							<td class='th2'  id='td_accName_606'>도서인쇄비 </td>
							<td class='th3'  id='td_chr_606'>5.분양경비</td>
							<td class='th4'  id='td_relname_606'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_606' value='20'>
						<input type='hidden' name='code_606' value='072600'><tr id='tr_607' onClick="goDetail('072700',607)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_607' id='chk_607' style='height:12px' value='Y' checked></td>
							<td class='th1' >0727</td>
							<td class='th2'  id='td_accName_607'>회의비 </td>
							<td class='th3'  id='td_chr_607'>5.분양경비</td>
							<td class='th4'  id='td_relname_607'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_607' value='20'>
						<input type='hidden' name='code_607' value='072700'><tr id='tr_608' onClick="goDetail('072800',608)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_608' id='chk_608' style='height:12px' value='Y' checked></td>
							<td class='th1' >0728</td>
							<td class='th2'  id='td_accName_608'>포장비 </td>
							<td class='th3'  id='td_chr_608'>5.분양경비</td>
							<td class='th4'  id='td_relname_608'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_608' value='20'>
						<input type='hidden' name='code_608' value='072800'><tr id='tr_609' onClick="goDetail('072900',609)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_609' id='chk_609' style='height:12px' value='Y' checked></td>
							<td class='th1' >0729</td>
							<td class='th2'  id='td_accName_609'>사무용품비 </td>
							<td class='th3'  id='td_chr_609'>5.분양경비</td>
							<td class='th4'  id='td_relname_609'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_609' value='20'>
						<input type='hidden' name='code_609' value='072900'><tr id='tr_610' onClick="goDetail('073000',610)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_610' id='chk_610' style='height:12px' value='Y' checked></td>
							<td class='th1' >0730</td>
							<td class='th2'  id='td_accName_610'>소모품비 </td>
							<td class='th3'  id='td_chr_610'>5.분양경비</td>
							<td class='th4'  id='td_relname_610'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_610' value='20'>
						<input type='hidden' name='code_610' value='073000'><tr id='tr_611' onClick="goDetail('073100',611)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_611' id='chk_611' style='height:12px' value='Y' checked></td>
							<td class='th1' >0731</td>
							<td class='th2'  id='td_accName_611'>수수료비용 </td>
							<td class='th3'  id='td_chr_611'>5.분양경비</td>
							<td class='th4'  id='td_relname_611'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_611' value='20'>
						<input type='hidden' name='code_611' value='073100'><tr id='tr_612' onClick="goDetail('073200',612)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_612' id='chk_612' style='height:12px' value='Y' checked></td>
							<td class='th1' >0732</td>
							<td class='th2'  id='td_accName_612'>보관료 </td>
							<td class='th3'  id='td_chr_612'>5.분양경비</td>
							<td class='th4'  id='td_relname_612'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_612' value='20'>
						<input type='hidden' name='code_612' value='073200'><tr id='tr_613' onClick="goDetail('073300',613)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_613' id='chk_613' style='height:12px' value='Y' checked></td>
							<td class='th1' >0733</td>
							<td class='th2'  id='td_accName_613'>외주가공비 </td>
							<td class='th3'  id='td_chr_613'>5.분양경비</td>
							<td class='th4'  id='td_relname_613'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_613' value='20'>
						<input type='hidden' name='code_613' value='073300'><tr id='tr_614' onClick="goDetail('073400',614)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_614' id='chk_614' style='height:12px' value='Y' checked></td>
							<td class='th1' >0734</td>
							<td class='th2'  id='td_accName_614'>시험비 </td>
							<td class='th3'  id='td_chr_614'>5.분양경비</td>
							<td class='th4'  id='td_relname_614'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_614' value='20'>
						<input type='hidden' name='code_614' value='073400'><tr id='tr_615' onClick="goDetail('073500',615)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_615' id='chk_615' style='height:12px' value='Y' checked></td>
							<td class='th1' >0735</td>
							<td class='th2'  id='td_accName_615'>설계용역비 </td>
							<td class='th3'  id='td_chr_615'>5.분양경비</td>
							<td class='th4'  id='td_relname_615'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_615' value='20'>
						<input type='hidden' name='code_615' value='073500'><tr id='tr_616' onClick="goDetail('073600',616)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_616' id='chk_616' style='height:12px' value='Y' checked></td>
							<td class='th1' >0736</td>
							<td class='th2'  id='td_accName_616'>가설재손료 </td>
							<td class='th3'  id='td_chr_616'>5.분양경비</td>
							<td class='th4'  id='td_relname_616'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_616' value='20'>
						<input type='hidden' name='code_616' value='073600'><tr id='tr_617' onClick="goDetail('073700',617)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_617' id='chk_617' style='height:12px' value='Y' checked></td>
							<td class='th1' >0737</td>
							<td class='th2'  id='td_accName_617'>잡비 </td>
							<td class='th3'  id='td_chr_617'>5.분양경비</td>
							<td class='th4'  id='td_relname_617'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_617' value='20'>
						<input type='hidden' name='code_617' value='073700'><tr id='tr_618' onClick="goDetail('073800',618)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_618' id='chk_618' style='height:12px' value='Y' checked></td>
							<td class='th1' >0738</td>
							<td class='th2'  id='td_accName_618'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_618'></td>
							<td class='th4'  id='td_relname_618'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_618' value='20'>
						<input type='hidden' name='code_618' value='073800'><tr id='tr_619' onClick="goDetail('073900',619)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_619' id='chk_619' style='height:12px' value='Y' checked></td>
							<td class='th1' >0739</td>
							<td class='th2'  id='td_accName_619'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_619'></td>
							<td class='th4'  id='td_relname_619'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_619' value='20'>
						<input type='hidden' name='code_619' value='073900'><tr id='tr_620' onClick="goDetail('074000',620)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_620' id='chk_620' style='height:12px' value='Y' checked></td>
							<td class='th1' >0740</td>
							<td class='th2'  id='td_accName_620'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_620'></td>
							<td class='th4'  id='td_relname_620'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_620' value='20'>
						<input type='hidden' name='code_620' value='074000'><tr id='tr_621' onClick="goDetail('074100',621)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_621' id='chk_621' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0741</td>
							<td class='th2' style='color:#ec4261' id='td_accName_621'>공사손실충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_621'>6.항목(집계)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_621'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_621' value='20'>
						<input type='hidden' name='code_621' value='074100'><tr id='tr_622' onClick="goDetail('074200',622)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_622' id='chk_622' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0742</td>
							<td class='th2' style='color:#ec4261' id='td_accName_622'>공사손실충당금환입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_622'>6.항목(집계)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_622'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_622' value='20'>
						<input type='hidden' name='code_622' value='074200'><tr id='tr_623' onClick="goDetail('074300',623)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_623' id='chk_623' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0743</td>
							<td class='th2' style='color:#ec4261' id='td_accName_623'>외주비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_623'>6.항목(집계)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_623'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_623' value='20'>
						<input type='hidden' name='code_623' value='074300'><tr id='tr_624' onClick="goDetail('074400',624)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_624' id='chk_624' style='height:12px' value='Y' checked></td>
							<td class='th1' >0744</td>
							<td class='th2'  id='td_accName_624'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_624'></td>
							<td class='th4'  id='td_relname_624'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_624' value='20'>
						<input type='hidden' name='code_624' value='074400'><tr id='tr_625' onClick="goDetail('074500',625)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_625' id='chk_625' style='height:12px' value='Y' checked></td>
							<td class='th1' >0745</td>
							<td class='th2'  id='td_accName_625'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_625'></td>
							<td class='th4'  id='td_relname_625'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_625' value='20'>
						<input type='hidden' name='code_625' value='074500'><tr id='tr_626' onClick="goDetail('074600',626)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_626' id='chk_626' style='height:12px' value='Y' checked></td>
							<td class='th1' >0746</td>
							<td class='th2'  id='td_accName_626'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_626'></td>
							<td class='th4'  id='td_relname_626'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_626' value='20'>
						<input type='hidden' name='code_626' value='074600'><tr id='tr_627' onClick="goDetail('074700',627)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_627' id='chk_627' style='height:12px' value='Y' checked></td>
							<td class='th1' >0747</td>
							<td class='th2'  id='td_accName_627'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_627'></td>
							<td class='th4'  id='td_relname_627'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_627' value='20'>
						<input type='hidden' name='code_627' value='074700'><tr id='tr_628' onClick="goDetail('074800',628)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_628' id='chk_628' style='height:12px' value='Y' checked></td>
							<td class='th1' >0748</td>
							<td class='th2'  id='td_accName_628'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_628'></td>
							<td class='th4'  id='td_relname_628'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_628' value='20'>
						<input type='hidden' name='code_628' value='074800'><tr id='tr_629' onClick="goDetail('074900',629)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_629' id='chk_629' style='height:12px' value='Y' checked></td>
							<td class='th1' >0749</td>
							<td class='th2'  id='td_accName_629'>명예퇴직금 </td>
							<td class='th3'  id='td_chr_629'>4.노무비(퇴직)</td>
							<td class='th4'  id='td_relname_629'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_629' value='20'>
						<input type='hidden' name='code_629' value='074900'><tr id='tr_630' onClick="goDetail('075000',630)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_630' id='chk_630' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0750</td>
							<td class='th2' style='color:#ec4261' id='td_accName_630'>퇴직연금충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_630'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_630'>분양원가</td>
						</tr>
						<input type='hidden' id='Scode_630' value='20'>
						<input type='hidden' name='code_630' value='075000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_21' id='S_21' style='height:12px' value='Y' onClick="chk_Scode('21')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='21'>운송원가</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_631' onClick="goDetail('075100',631)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_631' id='chk_631' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0751</td>
							<td class='th2' style='color:#ec4261' id='td_accName_631'>유류비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_631'>1.원재료비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_631'>유류</td>
						</tr>
						<input type='hidden' id='Scode_631' value='21'>
						<input type='hidden' name='code_631' value='075100'><tr id='tr_632' onClick="goDetail('075200',632)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_632' id='chk_632' style='height:12px' value='Y' checked></td>
							<td class='th1' >0752</td>
							<td class='th2'  id='td_accName_632'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_632'></td>
							<td class='th4'  id='td_relname_632'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_632' value='21'>
						<input type='hidden' name='code_632' value='075200'><tr id='tr_633' onClick="goDetail('075300',633)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_633' id='chk_633' style='height:12px' value='Y' checked></td>
							<td class='th1' >0753</td>
							<td class='th2'  id='td_accName_633'>급여 </td>
							<td class='th3'  id='td_chr_633'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_633'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_633' value='21'>
						<input type='hidden' name='code_633' value='075300'><tr id='tr_634' onClick="goDetail('075400',634)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_634' id='chk_634' style='height:12px' value='Y' checked></td>
							<td class='th1' >0754</td>
							<td class='th2'  id='td_accName_634'>임금 </td>
							<td class='th3'  id='td_chr_634'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_634'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_634' value='21'>
						<input type='hidden' name='code_634' value='075400'><tr id='tr_635' onClick="goDetail('075500',635)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_635' id='chk_635' style='height:12px' value='Y' checked></td>
							<td class='th1' >0755</td>
							<td class='th2'  id='td_accName_635'>상여금 </td>
							<td class='th3'  id='td_chr_635'>3.노무비(근로)</td>
							<td class='th4'  id='td_relname_635'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_635' value='21'>
						<input type='hidden' name='code_635' value='075500'><tr id='tr_636' onClick="goDetail('075600',636)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_636' id='chk_636' style='height:12px' value='Y' checked></td>
							<td class='th1' >0756</td>
							<td class='th2'  id='td_accName_636'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_636'></td>
							<td class='th4'  id='td_relname_636'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_636' value='21'>
						<input type='hidden' name='code_636' value='075600'><tr id='tr_637' onClick="goDetail('075700',637)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_637' id='chk_637' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0757</td>
							<td class='th2' style='color:#ec4261' id='td_accName_637'>퇴직급여 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_637'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_637'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_637' value='21'>
						<input type='hidden' name='code_637' value='075700'><tr id='tr_638' onClick="goDetail('075800',638)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_638' id='chk_638' style='height:12px' value='Y' checked></td>
							<td class='th1' >0758</td>
							<td class='th2'  id='td_accName_638'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_638'></td>
							<td class='th4'  id='td_relname_638'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_638' value='21'>
						<input type='hidden' name='code_638' value='075800'><tr id='tr_639' onClick="goDetail('075900',639)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_639' id='chk_639' style='height:12px' value='Y' checked></td>
							<td class='th1' >0759</td>
							<td class='th2'  id='td_accName_639'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_639'></td>
							<td class='th4'  id='td_relname_639'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_639' value='21'>
						<input type='hidden' name='code_639' value='075900'><tr id='tr_640' onClick="goDetail('076000',640)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_640' id='chk_640' style='height:12px' value='Y' checked></td>
							<td class='th1' >0760</td>
							<td class='th2'  id='td_accName_640'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_640'></td>
							<td class='th4'  id='td_relname_640'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_640' value='21'>
						<input type='hidden' name='code_640' value='076000'><tr id='tr_641' onClick="goDetail('076100',641)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_641' id='chk_641' style='height:12px' value='Y' checked></td>
							<td class='th1' >0761</td>
							<td class='th2'  id='td_accName_641'>복리후생비 </td>
							<td class='th3'  id='td_chr_641'>5.운송경비</td>
							<td class='th4'  id='td_relname_641'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_641' value='21'>
						<input type='hidden' name='code_641' value='076100'><tr id='tr_642' onClick="goDetail('076200',642)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_642' id='chk_642' style='height:12px' value='Y' checked></td>
							<td class='th1' >0762</td>
							<td class='th2'  id='td_accName_642'>여비교통비 </td>
							<td class='th3'  id='td_chr_642'>5.운송경비</td>
							<td class='th4'  id='td_relname_642'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_642' value='21'>
						<input type='hidden' name='code_642' value='076200'><tr id='tr_643' onClick="goDetail('076300',643)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_643' id='chk_643' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0763</td>
							<td class='th2' style='color:#ec4261' id='td_accName_643'>접대비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_643'>5.운송경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_643'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_643' value='21'>
						<input type='hidden' name='code_643' value='076300'><tr id='tr_644' onClick="goDetail('076400',644)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_644' id='chk_644' style='height:12px' value='Y' checked></td>
							<td class='th1' >0764</td>
							<td class='th2'  id='td_accName_644'>통신비 </td>
							<td class='th3'  id='td_chr_644'>5.운송경비</td>
							<td class='th4'  id='td_relname_644'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_644' value='21'>
						<input type='hidden' name='code_644' value='076400'><tr id='tr_645' onClick="goDetail('076500',645)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_645' id='chk_645' style='height:12px' value='Y' checked></td>
							<td class='th1' >0765</td>
							<td class='th2'  id='td_accName_645'>가스수도료 </td>
							<td class='th3'  id='td_chr_645'>5.운송경비</td>
							<td class='th4'  id='td_relname_645'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_645' value='21'>
						<input type='hidden' name='code_645' value='076500'><tr id='tr_646' onClick="goDetail('076600',646)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_646' id='chk_646' style='height:12px' value='Y' checked></td>
							<td class='th1' >0766</td>
							<td class='th2'  id='td_accName_646'>전력비 </td>
							<td class='th3'  id='td_chr_646'>5.운송경비</td>
							<td class='th4'  id='td_relname_646'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_646' value='21'>
						<input type='hidden' name='code_646' value='076600'><tr id='tr_647' onClick="goDetail('076700',647)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_647' id='chk_647' style='height:12px' value='Y' checked></td>
							<td class='th1' >0767</td>
							<td class='th2'  id='td_accName_647'>세금과공과 </td>
							<td class='th3'  id='td_chr_647'>5.운송경비</td>
							<td class='th4'  id='td_relname_647'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_647' value='21'>
						<input type='hidden' name='code_647' value='076700'><tr id='tr_648' onClick="goDetail('076800',648)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_648' id='chk_648' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0768</td>
							<td class='th2' style='color:#ec4261' id='td_accName_648'>감가상각비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_648'>5.운송경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_648'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_648' value='21'>
						<input type='hidden' name='code_648' value='076800'><tr id='tr_649' onClick="goDetail('076900',649)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_649' id='chk_649' style='height:12px' value='Y' checked></td>
							<td class='th1' >0769</td>
							<td class='th2'  id='td_accName_649'>임차료 </td>
							<td class='th3'  id='td_chr_649'>5.운송경비</td>
							<td class='th4'  id='td_relname_649'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_649' value='21'>
						<input type='hidden' name='code_649' value='076900'><tr id='tr_650' onClick="goDetail('077000',650)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_650' id='chk_650' style='height:12px' value='Y' checked></td>
							<td class='th1' >0770</td>
							<td class='th2'  id='td_accName_650'>수선비 </td>
							<td class='th3'  id='td_chr_650'>5.운송경비</td>
							<td class='th4'  id='td_relname_650'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_650' value='21'>
						<input type='hidden' name='code_650' value='077000'><tr id='tr_651' onClick="goDetail('077100',651)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_651' id='chk_651' style='height:12px' value='Y' checked></td>
							<td class='th1' >0771</td>
							<td class='th2'  id='td_accName_651'>보험료 </td>
							<td class='th3'  id='td_chr_651'>5.운송경비</td>
							<td class='th4'  id='td_relname_651'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_651' value='21'>
						<input type='hidden' name='code_651' value='077100'><tr id='tr_652' onClick="goDetail('077200',652)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_652' id='chk_652' style='height:12px' value='Y' checked></td>
							<td class='th1' >0772</td>
							<td class='th2'  id='td_accName_652'>차량유지비 </td>
							<td class='th3'  id='td_chr_652'>5.운송경비</td>
							<td class='th4'  id='td_relname_652'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_652' value='21'>
						<input type='hidden' name='code_652' value='077200'><tr id='tr_653' onClick="goDetail('077300',653)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_653' id='chk_653' style='height:12px' value='Y' checked></td>
							<td class='th1' >0773</td>
							<td class='th2'  id='td_accName_653'>통행료 </td>
							<td class='th3'  id='td_chr_653'>5.운송경비</td>
							<td class='th4'  id='td_relname_653'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_653' value='21'>
						<input type='hidden' name='code_653' value='077300'><tr id='tr_654' onClick="goDetail('077400',654)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_654' id='chk_654' style='height:12px' value='Y' checked></td>
							<td class='th1' >0774</td>
							<td class='th2'  id='td_accName_654'>청소비 </td>
							<td class='th3'  id='td_chr_654'>5.운송경비</td>
							<td class='th4'  id='td_relname_654'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_654' value='21'>
						<input type='hidden' name='code_654' value='077400'><tr id='tr_655' onClick="goDetail('077500',655)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_655' id='chk_655' style='height:12px' value='Y' checked></td>
							<td class='th1' >0775</td>
							<td class='th2'  id='td_accName_655'>교육훈련비 </td>
							<td class='th3'  id='td_chr_655'>5.운송경비</td>
							<td class='th4'  id='td_relname_655'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_655' value='21'>
						<input type='hidden' name='code_655' value='077500'><tr id='tr_656' onClick="goDetail('077600',656)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_656' id='chk_656' style='height:12px' value='Y' checked></td>
							<td class='th1' >0776</td>
							<td class='th2'  id='td_accName_656'>도서인쇄비 </td>
							<td class='th3'  id='td_chr_656'>5.운송경비</td>
							<td class='th4'  id='td_relname_656'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_656' value='21'>
						<input type='hidden' name='code_656' value='077600'><tr id='tr_657' onClick="goDetail('077700',657)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_657' id='chk_657' style='height:12px' value='Y' checked></td>
							<td class='th1' >0777</td>
							<td class='th2'  id='td_accName_657'>회의비 </td>
							<td class='th3'  id='td_chr_657'>5.운송경비</td>
							<td class='th4'  id='td_relname_657'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_657' value='21'>
						<input type='hidden' name='code_657' value='077700'><tr id='tr_658' onClick="goDetail('077800',658)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_658' id='chk_658' style='height:12px' value='Y' checked></td>
							<td class='th1' >0778</td>
							<td class='th2'  id='td_accName_658'>포장비 </td>
							<td class='th3'  id='td_chr_658'>5.운송경비</td>
							<td class='th4'  id='td_relname_658'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_658' value='21'>
						<input type='hidden' name='code_658' value='077800'><tr id='tr_659' onClick="goDetail('077900',659)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_659' id='chk_659' style='height:12px' value='Y' checked></td>
							<td class='th1' >0779</td>
							<td class='th2'  id='td_accName_659'>사무용품비 </td>
							<td class='th3'  id='td_chr_659'>5.운송경비</td>
							<td class='th4'  id='td_relname_659'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_659' value='21'>
						<input type='hidden' name='code_659' value='077900'><tr id='tr_660' onClick="goDetail('078000',660)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_660' id='chk_660' style='height:12px' value='Y' checked></td>
							<td class='th1' >0780</td>
							<td class='th2'  id='td_accName_660'>소모품비 </td>
							<td class='th3'  id='td_chr_660'>5.운송경비</td>
							<td class='th4'  id='td_relname_660'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_660' value='21'>
						<input type='hidden' name='code_660' value='078000'><tr id='tr_661' onClick="goDetail('078100',661)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_661' id='chk_661' style='height:12px' value='Y' checked></td>
							<td class='th1' >0781</td>
							<td class='th2'  id='td_accName_661'>수수료비용 </td>
							<td class='th3'  id='td_chr_661'>5.운송경비</td>
							<td class='th4'  id='td_relname_661'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_661' value='21'>
						<input type='hidden' name='code_661' value='078100'><tr id='tr_662' onClick="goDetail('078200',662)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_662' id='chk_662' style='height:12px' value='Y' checked></td>
							<td class='th1' >0782</td>
							<td class='th2'  id='td_accName_662'>보관료 </td>
							<td class='th3'  id='td_chr_662'>5.운송경비</td>
							<td class='th4'  id='td_relname_662'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_662' value='21'>
						<input type='hidden' name='code_662' value='078200'><tr id='tr_663' onClick="goDetail('078300',663)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_663' id='chk_663' style='height:12px' value='Y' checked></td>
							<td class='th1' >0783</td>
							<td class='th2'  id='td_accName_663'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_663'></td>
							<td class='th4'  id='td_relname_663'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_663' value='21'>
						<input type='hidden' name='code_663' value='078300'><tr id='tr_664' onClick="goDetail('078400',664)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_664' id='chk_664' style='height:12px' value='Y' checked></td>
							<td class='th1' >0784</td>
							<td class='th2'  id='td_accName_664'>하역작업료 </td>
							<td class='th3'  id='td_chr_664'>5.운송경비</td>
							<td class='th4'  id='td_relname_664'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_664' value='21'>
						<input type='hidden' name='code_664' value='078400'><tr id='tr_665' onClick="goDetail('078500',665)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_665' id='chk_665' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0785</td>
							<td class='th2' style='color:#ec4261' id='td_accName_665'>퇴직연금충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_665'>4.노무비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_665'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_665' value='21'>
						<input type='hidden' name='code_665' value='078500'><tr id='tr_666' onClick="goDetail('078600',666)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_666' id='chk_666' style='height:12px' value='Y' checked></td>
							<td class='th1' >0786</td>
							<td class='th2'  id='td_accName_666'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_666'></td>
							<td class='th4'  id='td_relname_666'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_666' value='21'>
						<input type='hidden' name='code_666' value='078600'><tr id='tr_667' onClick="goDetail('078700',667)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_667' id='chk_667' style='height:12px' value='Y' checked></td>
							<td class='th1' >0787</td>
							<td class='th2'  id='td_accName_667'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_667'></td>
							<td class='th4'  id='td_relname_667'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_667' value='21'>
						<input type='hidden' name='code_667' value='078700'><tr id='tr_668' onClick="goDetail('078800',668)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_668' id='chk_668' style='height:12px' value='Y' checked></td>
							<td class='th1' >0788</td>
							<td class='th2'  id='td_accName_668'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_668'></td>
							<td class='th4'  id='td_relname_668'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_668' value='21'>
						<input type='hidden' name='code_668' value='078800'><tr id='tr_669' onClick="goDetail('078900',669)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_669' id='chk_669' style='height:12px' value='Y' checked></td>
							<td class='th1' >0789</td>
							<td class='th2'  id='td_accName_669'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_669'></td>
							<td class='th4'  id='td_relname_669'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_669' value='21'>
						<input type='hidden' name='code_669' value='078900'><tr id='tr_670' onClick="goDetail('079000',670)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_670' id='chk_670' style='height:12px' value='Y' checked></td>
							<td class='th1' >0790</td>
							<td class='th2'  id='td_accName_670'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_670'></td>
							<td class='th4'  id='td_relname_670'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_670' value='21'>
						<input type='hidden' name='code_670' value='079000'><tr id='tr_671' onClick="goDetail('079100',671)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_671' id='chk_671' style='height:12px' value='Y' checked></td>
							<td class='th1' >0791</td>
							<td class='th2'  id='td_accName_671'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_671'></td>
							<td class='th4'  id='td_relname_671'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_671' value='21'>
						<input type='hidden' name='code_671' value='079100'><tr id='tr_672' onClick="goDetail('079200',672)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_672' id='chk_672' style='height:12px' value='Y' checked></td>
							<td class='th1' >0792</td>
							<td class='th2'  id='td_accName_672'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_672'></td>
							<td class='th4'  id='td_relname_672'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_672' value='21'>
						<input type='hidden' name='code_672' value='079200'><tr id='tr_673' onClick="goDetail('079300',673)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_673' id='chk_673' style='height:12px' value='Y' checked></td>
							<td class='th1' >0793</td>
							<td class='th2'  id='td_accName_673'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_673'></td>
							<td class='th4'  id='td_relname_673'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_673' value='21'>
						<input type='hidden' name='code_673' value='079300'><tr id='tr_674' onClick="goDetail('079400',674)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_674' id='chk_674' style='height:12px' value='Y' checked></td>
							<td class='th1' >0794</td>
							<td class='th2'  id='td_accName_674'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_674'></td>
							<td class='th4'  id='td_relname_674'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_674' value='21'>
						<input type='hidden' name='code_674' value='079400'><tr id='tr_675' onClick="goDetail('079500',675)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_675' id='chk_675' style='height:12px' value='Y' checked></td>
							<td class='th1' >0795</td>
							<td class='th2'  id='td_accName_675'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_675'></td>
							<td class='th4'  id='td_relname_675'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_675' value='21'>
						<input type='hidden' name='code_675' value='079500'><tr id='tr_676' onClick="goDetail('079600',676)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_676' id='chk_676' style='height:12px' value='Y' checked></td>
							<td class='th1' >0796</td>
							<td class='th2'  id='td_accName_676'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_676'></td>
							<td class='th4'  id='td_relname_676'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_676' value='21'>
						<input type='hidden' name='code_676' value='079600'><tr id='tr_677' onClick="goDetail('079700',677)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_677' id='chk_677' style='height:12px' value='Y' checked></td>
							<td class='th1' >0797</td>
							<td class='th2'  id='td_accName_677'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_677'></td>
							<td class='th4'  id='td_relname_677'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_677' value='21'>
						<input type='hidden' name='code_677' value='079700'><tr id='tr_678' onClick="goDetail('079800',678)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_678' id='chk_678' style='height:12px' value='Y' checked></td>
							<td class='th1' >0798</td>
							<td class='th2'  id='td_accName_678'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_678'></td>
							<td class='th4'  id='td_relname_678'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_678' value='21'>
						<input type='hidden' name='code_678' value='079800'><tr id='tr_679' onClick="goDetail('079900',679)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_679' id='chk_679' style='height:12px' value='Y' checked></td>
							<td class='th1' >0799</td>
							<td class='th2'  id='td_accName_679'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_679'></td>
							<td class='th4'  id='td_relname_679'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_679' value='21'>
						<input type='hidden' name='code_679' value='079900'><tr id='tr_680' onClick="goDetail('080000',680)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_680' id='chk_680' style='height:12px' value='Y' checked></td>
							<td class='th1' >0800</td>
							<td class='th2'  id='td_accName_680'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_680'></td>
							<td class='th4'  id='td_relname_680'>운송원가</td>
						</tr>
						<input type='hidden' id='Scode_680' value='21'>
						<input type='hidden' name='code_680' value='080000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_22' id='S_22' style='height:12px' value='Y' onClick="chk_Scode('22')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='22'>판매비및일반관리비</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_681' onClick="goDetail('080100',681)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_681' id='chk_681' style='height:12px' value='Y' checked></td>
							<td class='th1' >0801</td>
							<td class='th2'  id='td_accName_681'>임원급여 </td>
							<td class='th3'  id='td_chr_681'>1.인건비(근로)</td>
							<td class='th4'  id='td_relname_681'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_681' value='22'>
						<input type='hidden' name='code_681' value='080100'><tr id='tr_682' onClick="goDetail('080200',682)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_682' id='chk_682' style='height:12px' value='Y' checked></td>
							<td class='th1' >0802</td>
							<td class='th2'  id='td_accName_682'>직원급여 </td>
							<td class='th3'  id='td_chr_682'>1.인건비(근로)</td>
							<td class='th4'  id='td_relname_682'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_682' value='22'>
						<input type='hidden' name='code_682' value='080200'><tr id='tr_683' onClick="goDetail('080300',683)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_683' id='chk_683' style='height:12px' value='Y' checked></td>
							<td class='th1' >0803</td>
							<td class='th2'  id='td_accName_683'>상여금 </td>
							<td class='th3'  id='td_chr_683'>1.인건비(근로)</td>
							<td class='th4'  id='td_relname_683'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_683' value='22'>
						<input type='hidden' name='code_683' value='080300'><tr id='tr_684' onClick="goDetail('080400',684)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_684' id='chk_684' style='height:12px' value='Y' checked></td>
							<td class='th1' >0804</td>
							<td class='th2'  id='td_accName_684'>제수당 </td>
							<td class='th3'  id='td_chr_684'>1.인건비(근로)</td>
							<td class='th4'  id='td_relname_684'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_684' value='22'>
						<input type='hidden' name='code_684' value='080400'><tr id='tr_685' onClick="goDetail('080500',685)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_685' id='chk_685' style='height:12px' value='Y' checked></td>
							<td class='th1' >0805</td>
							<td class='th2'  id='td_accName_685'>잡급 </td>
							<td class='th3'  id='td_chr_685'>1.인건비(근로)</td>
							<td class='th4'  id='td_relname_685'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_685' value='22'>
						<input type='hidden' name='code_685' value='080500'><tr id='tr_686' onClick="goDetail('080600',686)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_686' id='chk_686' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0806</td>
							<td class='th2' style='color:#ec4261' id='td_accName_686'>퇴직급여 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_686'>2.인건비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_686'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_686' value='22'>
						<input type='hidden' name='code_686' value='080600'><tr id='tr_687' onClick="goDetail('080700',687)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_687' id='chk_687' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0807</td>
							<td class='th2' style='color:#ec4261' id='td_accName_687'>퇴직보험충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_687'>2.인건비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_687'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_687' value='22'>
						<input type='hidden' name='code_687' value='080700'><tr id='tr_688' onClick="goDetail('080800',688)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_688' id='chk_688' style='height:12px' value='Y' checked></td>
							<td class='th1' >0808</td>
							<td class='th2'  id='td_accName_688'>급료와임금 </td>
							<td class='th3'  id='td_chr_688'>1.인건비(근로)</td>
							<td class='th4'  id='td_relname_688'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_688' value='22'>
						<input type='hidden' name='code_688' value='080800'><tr id='tr_689' onClick="goDetail('080900',689)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_689' id='chk_689' style='height:12px' value='Y' checked></td>
							<td class='th1' >0809</td>
							<td class='th2'  id='td_accName_689'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_689'></td>
							<td class='th4'  id='td_relname_689'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_689' value='22'>
						<input type='hidden' name='code_689' value='080900'><tr id='tr_690' onClick="goDetail('081000',690)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_690' id='chk_690' style='height:12px' value='Y' checked></td>
							<td class='th1' >0810</td>
							<td class='th2'  id='td_accName_690'>퇴직금 </td>
							<td class='th3'  id='td_chr_690'>3.경비</td>
							<td class='th4'  id='td_relname_690'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_690' value='22'>
						<input type='hidden' name='code_690' value='081000'><tr id='tr_691' onClick="goDetail('081100',691)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_691' id='chk_691' style='height:12px' value='Y' checked></td>
							<td class='th1' >0811</td>
							<td class='th2'  id='td_accName_691'>복리후생비 </td>
							<td class='th3'  id='td_chr_691'>3.경비</td>
							<td class='th4'  id='td_relname_691'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_691' value='22'>
						<input type='hidden' name='code_691' value='081100'><tr id='tr_692' onClick="goDetail('081200',692)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_692' id='chk_692' style='height:12px' value='Y' checked></td>
							<td class='th1' >0812</td>
							<td class='th2'  id='td_accName_692'>여비교통비 </td>
							<td class='th3'  id='td_chr_692'>3.경비</td>
							<td class='th4'  id='td_relname_692'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_692' value='22'>
						<input type='hidden' name='code_692' value='081200'><tr id='tr_693' onClick="goDetail('081300',693)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_693' id='chk_693' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0813</td>
							<td class='th2' style='color:#ec4261' id='td_accName_693'>접대비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_693'>3.경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_693'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_693' value='22'>
						<input type='hidden' name='code_693' value='081300'><tr id='tr_694' onClick="goDetail('081400',694)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_694' id='chk_694' style='height:12px' value='Y' checked></td>
							<td class='th1' >0814</td>
							<td class='th2'  id='td_accName_694'>통신비 </td>
							<td class='th3'  id='td_chr_694'>3.경비</td>
							<td class='th4'  id='td_relname_694'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_694' value='22'>
						<input type='hidden' name='code_694' value='081400'><tr id='tr_695' onClick="goDetail('081500',695)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_695' id='chk_695' style='height:12px' value='Y' checked></td>
							<td class='th1' >0815</td>
							<td class='th2'  id='td_accName_695'>수도광열비 </td>
							<td class='th3'  id='td_chr_695'>3.경비</td>
							<td class='th4'  id='td_relname_695'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_695' value='22'>
						<input type='hidden' name='code_695' value='081500'><tr id='tr_696' onClick="goDetail('081600',696)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_696' id='chk_696' style='height:12px' value='Y' checked></td>
							<td class='th1' >0816</td>
							<td class='th2'  id='td_accName_696'>전력비 </td>
							<td class='th3'  id='td_chr_696'>3.경비</td>
							<td class='th4'  id='td_relname_696'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_696' value='22'>
						<input type='hidden' name='code_696' value='081600'><tr id='tr_697' onClick="goDetail('081700',697)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_697' id='chk_697' style='height:12px' value='Y' checked></td>
							<td class='th1' >0817</td>
							<td class='th2'  id='td_accName_697'>세금과공과 </td>
							<td class='th3'  id='td_chr_697'>3.경비</td>
							<td class='th4'  id='td_relname_697'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_697' value='22'>
						<input type='hidden' name='code_697' value='081700'><tr id='tr_698' onClick="goDetail('081800',698)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_698' id='chk_698' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0818</td>
							<td class='th2' style='color:#ec4261' id='td_accName_698'>감가상각비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_698'>3.경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_698'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_698' value='22'>
						<input type='hidden' name='code_698' value='081800'><tr id='tr_699' onClick="goDetail('081900',699)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_699' id='chk_699' style='height:12px' value='Y' checked></td>
							<td class='th1' >0819</td>
							<td class='th2'  id='td_accName_699'>임차료 </td>
							<td class='th3'  id='td_chr_699'>3.경비</td>
							<td class='th4'  id='td_relname_699'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_699' value='22'>
						<input type='hidden' name='code_699' value='081900'><tr id='tr_700' onClick="goDetail('082000',700)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_700' id='chk_700' style='height:12px' value='Y' checked></td>
							<td class='th1' >0820</td>
							<td class='th2'  id='td_accName_700'>수선비 </td>
							<td class='th3'  id='td_chr_700'>3.경비</td>
							<td class='th4'  id='td_relname_700'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_700' value='22'>
						<input type='hidden' name='code_700' value='082000'><tr id='tr_701' onClick="goDetail('082100',701)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_701' id='chk_701' style='height:12px' value='Y' checked></td>
							<td class='th1' >0821</td>
							<td class='th2'  id='td_accName_701'>보험료 </td>
							<td class='th3'  id='td_chr_701'>3.경비</td>
							<td class='th4'  id='td_relname_701'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_701' value='22'>
						<input type='hidden' name='code_701' value='082100'><tr id='tr_702' onClick="goDetail('082200',702)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_702' id='chk_702' style='height:12px' value='Y' checked></td>
							<td class='th1' >0822</td>
							<td class='th2'  id='td_accName_702'>차량유지비 </td>
							<td class='th3'  id='td_chr_702'>3.경비</td>
							<td class='th4'  id='td_relname_702'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_702' value='22'>
						<input type='hidden' name='code_702' value='082200'><tr id='tr_703' onClick="goDetail('082300',703)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_703' id='chk_703' style='height:12px' value='Y' checked></td>
							<td class='th1' >0823</td>
							<td class='th2'  id='td_accName_703'>경상연구개발비 </td>
							<td class='th3'  id='td_chr_703'>3.경비</td>
							<td class='th4'  id='td_relname_703'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_703' value='22'>
						<input type='hidden' name='code_703' value='082300'><tr id='tr_704' onClick="goDetail('082400',704)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_704' id='chk_704' style='height:12px' value='Y' checked></td>
							<td class='th1' >0824</td>
							<td class='th2'  id='td_accName_704'>운반비 </td>
							<td class='th3'  id='td_chr_704'>3.경비</td>
							<td class='th4'  id='td_relname_704'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_704' value='22'>
						<input type='hidden' name='code_704' value='082400'><tr id='tr_705' onClick="goDetail('082500',705)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_705' id='chk_705' style='height:12px' value='Y' checked></td>
							<td class='th1' >0825</td>
							<td class='th2'  id='td_accName_705'>교육훈련비 </td>
							<td class='th3'  id='td_chr_705'>3.경비</td>
							<td class='th4'  id='td_relname_705'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_705' value='22'>
						<input type='hidden' name='code_705' value='082500'><tr id='tr_706' onClick="goDetail('082600',706)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_706' id='chk_706' style='height:12px' value='Y' checked></td>
							<td class='th1' >0826</td>
							<td class='th2'  id='td_accName_706'>도서인쇄비 </td>
							<td class='th3'  id='td_chr_706'>3.경비</td>
							<td class='th4'  id='td_relname_706'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_706' value='22'>
						<input type='hidden' name='code_706' value='082600'><tr id='tr_707' onClick="goDetail('082700',707)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_707' id='chk_707' style='height:12px' value='Y' checked></td>
							<td class='th1' >0827</td>
							<td class='th2'  id='td_accName_707'>회의비 </td>
							<td class='th3'  id='td_chr_707'>3.경비</td>
							<td class='th4'  id='td_relname_707'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_707' value='22'>
						<input type='hidden' name='code_707' value='082700'><tr id='tr_708' onClick="goDetail('082800',708)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_708' id='chk_708' style='height:12px' value='Y' checked></td>
							<td class='th1' >0828</td>
							<td class='th2'  id='td_accName_708'>포장비 </td>
							<td class='th3'  id='td_chr_708'>3.경비</td>
							<td class='th4'  id='td_relname_708'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_708' value='22'>
						<input type='hidden' name='code_708' value='082800'><tr id='tr_709' onClick="goDetail('082900',709)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_709' id='chk_709' style='height:12px' value='Y' checked></td>
							<td class='th1' >0829</td>
							<td class='th2'  id='td_accName_709'>사무용품비 </td>
							<td class='th3'  id='td_chr_709'>3.경비</td>
							<td class='th4'  id='td_relname_709'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_709' value='22'>
						<input type='hidden' name='code_709' value='082900'><tr id='tr_710' onClick="goDetail('083000',710)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_710' id='chk_710' style='height:12px' value='Y' checked></td>
							<td class='th1' >0830</td>
							<td class='th2'  id='td_accName_710'>소모품비 </td>
							<td class='th3'  id='td_chr_710'>3.경비</td>
							<td class='th4'  id='td_relname_710'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_710' value='22'>
						<input type='hidden' name='code_710' value='083000'><tr id='tr_711' onClick="goDetail('083100',711)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_711' id='chk_711' style='height:12px' value='Y' checked></td>
							<td class='th1' >0831</td>
							<td class='th2'  id='td_accName_711'>지급수수료 </td>
							<td class='th3'  id='td_chr_711'>3.경비</td>
							<td class='th4'  id='td_relname_711'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_711' value='22'>
						<input type='hidden' name='code_711' value='083100'><tr id='tr_712' onClick="goDetail('083200',712)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_712' id='chk_712' style='height:12px' value='Y' checked></td>
							<td class='th1' >0832</td>
							<td class='th2'  id='td_accName_712'>보관료 </td>
							<td class='th3'  id='td_chr_712'>3.경비</td>
							<td class='th4'  id='td_relname_712'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_712' value='22'>
						<input type='hidden' name='code_712' value='083200'><tr id='tr_713' onClick="goDetail('083300',713)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_713' id='chk_713' style='height:12px' value='Y' checked></td>
							<td class='th1' >0833</td>
							<td class='th2'  id='td_accName_713'>광고선전비 </td>
							<td class='th3'  id='td_chr_713'>3.경비</td>
							<td class='th4'  id='td_relname_713'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_713' value='22'>
						<input type='hidden' name='code_713' value='083300'><tr id='tr_714' onClick="goDetail('083400',714)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_714' id='chk_714' style='height:12px' value='Y' checked></td>
							<td class='th1' >0834</td>
							<td class='th2'  id='td_accName_714'>판매촉진비 </td>
							<td class='th3'  id='td_chr_714'>3.경비</td>
							<td class='th4'  id='td_relname_714'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_714' value='22'>
						<input type='hidden' name='code_714' value='083400'><tr id='tr_715' onClick="goDetail('083500',715)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_715' id='chk_715' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0835</td>
							<td class='th2' style='color:#ec4261' id='td_accName_715'>대손상각비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_715'>3.경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_715'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_715' value='22'>
						<input type='hidden' name='code_715' value='083500'><tr id='tr_716' onClick="goDetail('083600',716)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_716' id='chk_716' style='height:12px' value='Y' checked></td>
							<td class='th1' >0836</td>
							<td class='th2'  id='td_accName_716'>기밀비 </td>
							<td class='th3'  id='td_chr_716'>3.경비</td>
							<td class='th4'  id='td_relname_716'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_716' value='22'>
						<input type='hidden' name='code_716' value='083600'><tr id='tr_717' onClick="goDetail('083700',717)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_717' id='chk_717' style='height:12px' value='Y' checked></td>
							<td class='th1' >0837</td>
							<td class='th2'  id='td_accName_717'>건물관리비 </td>
							<td class='th3'  id='td_chr_717'>3.경비</td>
							<td class='th4'  id='td_relname_717'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_717' value='22'>
						<input type='hidden' name='code_717' value='083700'><tr id='tr_718' onClick="goDetail('083800',718)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_718' id='chk_718' style='height:12px' value='Y' checked></td>
							<td class='th1' >0838</td>
							<td class='th2'  id='td_accName_718'>수출제비용 </td>
							<td class='th3'  id='td_chr_718'>3.경비</td>
							<td class='th4'  id='td_relname_718'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_718' value='22'>
						<input type='hidden' name='code_718' value='083800'><tr id='tr_719' onClick="goDetail('083900',719)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_719' id='chk_719' style='height:12px' value='Y' checked></td>
							<td class='th1' >0839</td>
							<td class='th2'  id='td_accName_719'>판매수수료 </td>
							<td class='th3'  id='td_chr_719'>3.경비</td>
							<td class='th4'  id='td_relname_719'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_719' value='22'>
						<input type='hidden' name='code_719' value='083900'><tr id='tr_720' onClick="goDetail('084000',720)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_720' id='chk_720' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0840</td>
							<td class='th2' style='color:#ec4261' id='td_accName_720'>무형자산상각비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_720'>3.경비</td>
							<td class='th4' style='color:#ec4261' id='td_relname_720'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_720' value='22'>
						<input type='hidden' name='code_720' value='084000'><tr id='tr_721' onClick="goDetail('084100',721)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_721' id='chk_721' style='height:12px' value='Y' checked></td>
							<td class='th1' >0841</td>
							<td class='th2'  id='td_accName_721'>환가료 </td>
							<td class='th3'  id='td_chr_721'>3.경비</td>
							<td class='th4'  id='td_relname_721'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_721' value='22'>
						<input type='hidden' name='code_721' value='084100'><tr id='tr_722' onClick="goDetail('084200',722)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_722' id='chk_722' style='height:12px' value='Y' checked></td>
							<td class='th1' >0842</td>
							<td class='th2'  id='td_accName_722'>견본비 </td>
							<td class='th3'  id='td_chr_722'>3.경비</td>
							<td class='th4'  id='td_relname_722'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_722' value='22'>
						<input type='hidden' name='code_722' value='084200'><tr id='tr_723' onClick="goDetail('084300',723)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_723' id='chk_723' style='height:12px' value='Y' checked></td>
							<td class='th1' >0843</td>
							<td class='th2'  id='td_accName_723'>해외접대비 </td>
							<td class='th3'  id='td_chr_723'>3.경비</td>
							<td class='th4'  id='td_relname_723'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_723' value='22'>
						<input type='hidden' name='code_723' value='084300'><tr id='tr_724' onClick="goDetail('084400',724)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_724' id='chk_724' style='height:12px' value='Y' checked></td>
							<td class='th1' >0844</td>
							<td class='th2'  id='td_accName_724'>해외시장개척비 </td>
							<td class='th3'  id='td_chr_724'>3.경비</td>
							<td class='th4'  id='td_relname_724'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_724' value='22'>
						<input type='hidden' name='code_724' value='084400'><tr id='tr_725' onClick="goDetail('084500',725)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_725' id='chk_725' style='height:12px' value='Y' checked></td>
							<td class='th1' >0845</td>
							<td class='th2'  id='td_accName_725'>미분양주택관리비 </td>
							<td class='th3'  id='td_chr_725'>3.경비</td>
							<td class='th4'  id='td_relname_725'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_725' value='22'>
						<input type='hidden' name='code_725' value='084500'><tr id='tr_726' onClick="goDetail('084600',726)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_726' id='chk_726' style='height:12px' value='Y' checked></td>
							<td class='th1' >0846</td>
							<td class='th2'  id='td_accName_726'>수주비 </td>
							<td class='th3'  id='td_chr_726'>3.경비</td>
							<td class='th4'  id='td_relname_726'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_726' value='22'>
						<input type='hidden' name='code_726' value='084600'><tr id='tr_727' onClick="goDetail('084700',727)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_727' id='chk_727' style='height:12px' value='Y' checked></td>
							<td class='th1' >0847</td>
							<td class='th2'  id='td_accName_727'>하자보수충당금전입 </td>
							<td class='th3'  id='td_chr_727'>3.경비</td>
							<td class='th4'  id='td_relname_727'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_727' value='22'>
						<input type='hidden' name='code_727' value='084700'><tr id='tr_728' onClick="goDetail('084800',728)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_728' id='chk_728' style='height:12px' value='Y' checked></td>
							<td class='th1' >0848</td>
							<td class='th2'  id='td_accName_728'>잡비 </td>
							<td class='th3'  id='td_chr_728'>3.경비</td>
							<td class='th4'  id='td_relname_728'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_728' value='22'>
						<input type='hidden' name='code_728' value='084800'><tr id='tr_729' onClick="goDetail('084900',729)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_729' id='chk_729' style='height:12px' value='Y' checked></td>
							<td class='th1' >0849</td>
							<td class='th2'  id='td_accName_729'>명예퇴직금 </td>
							<td class='th3'  id='td_chr_729'>2.인건비(퇴직)</td>
							<td class='th4'  id='td_relname_729'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_729' value='22'>
						<input type='hidden' name='code_729' value='084900'><tr id='tr_730' onClick="goDetail('085000',730)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_730' id='chk_730' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0850</td>
							<td class='th2' style='color:#ec4261' id='td_accName_730'>퇴직연금충당금전입 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_730'>2.인건비(퇴직)</td>
							<td class='th4' style='color:#ec4261' id='td_relname_730'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_730' value='22'>
						<input type='hidden' name='code_730' value='085000'><tr id='tr_731' onClick="goDetail('085100',731)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_731' id='chk_731' style='height:12px' value='Y' checked></td>
							<td class='th1' >0851</td>
							<td class='th2'  id='td_accName_731'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_731'></td>
							<td class='th4'  id='td_relname_731'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_731' value='22'>
						<input type='hidden' name='code_731' value='085100'><tr id='tr_732' onClick="goDetail('085200',732)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_732' id='chk_732' style='height:12px' value='Y' checked></td>
							<td class='th1' >0852</td>
							<td class='th2'  id='td_accName_732'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_732'></td>
							<td class='th4'  id='td_relname_732'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_732' value='22'>
						<input type='hidden' name='code_732' value='085200'><tr id='tr_733' onClick="goDetail('085300',733)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_733' id='chk_733' style='height:12px' value='Y' checked></td>
							<td class='th1' >0853</td>
							<td class='th2'  id='td_accName_733'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_733'></td>
							<td class='th4'  id='td_relname_733'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_733' value='22'>
						<input type='hidden' name='code_733' value='085300'><tr id='tr_734' onClick="goDetail('085400',734)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_734' id='chk_734' style='height:12px' value='Y' checked></td>
							<td class='th1' >0854</td>
							<td class='th2'  id='td_accName_734'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_734'></td>
							<td class='th4'  id='td_relname_734'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_734' value='22'>
						<input type='hidden' name='code_734' value='085400'><tr id='tr_735' onClick="goDetail('085500',735)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_735' id='chk_735' style='height:12px' value='Y' checked></td>
							<td class='th1' >0855</td>
							<td class='th2'  id='td_accName_735'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_735'></td>
							<td class='th4'  id='td_relname_735'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_735' value='22'>
						<input type='hidden' name='code_735' value='085500'><tr id='tr_736' onClick="goDetail('085600',736)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_736' id='chk_736' style='height:12px' value='Y' checked></td>
							<td class='th1' >0856</td>
							<td class='th2'  id='td_accName_736'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_736'></td>
							<td class='th4'  id='td_relname_736'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_736' value='22'>
						<input type='hidden' name='code_736' value='085600'><tr id='tr_737' onClick="goDetail('085700',737)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_737' id='chk_737' style='height:12px' value='Y' checked></td>
							<td class='th1' >0857</td>
							<td class='th2'  id='td_accName_737'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_737'></td>
							<td class='th4'  id='td_relname_737'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_737' value='22'>
						<input type='hidden' name='code_737' value='085700'><tr id='tr_738' onClick="goDetail('085800',738)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_738' id='chk_738' style='height:12px' value='Y' checked></td>
							<td class='th1' >0858</td>
							<td class='th2'  id='td_accName_738'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_738'></td>
							<td class='th4'  id='td_relname_738'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_738' value='22'>
						<input type='hidden' name='code_738' value='085800'><tr id='tr_739' onClick="goDetail('085900',739)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_739' id='chk_739' style='height:12px' value='Y' checked></td>
							<td class='th1' >0859</td>
							<td class='th2'  id='td_accName_739'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_739'></td>
							<td class='th4'  id='td_relname_739'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_739' value='22'>
						<input type='hidden' name='code_739' value='085900'><tr id='tr_740' onClick="goDetail('086000',740)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_740' id='chk_740' style='height:12px' value='Y' checked></td>
							<td class='th1' >0860</td>
							<td class='th2'  id='td_accName_740'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_740'></td>
							<td class='th4'  id='td_relname_740'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_740' value='22'>
						<input type='hidden' name='code_740' value='086000'><tr id='tr_741' onClick="goDetail('086100',741)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_741' id='chk_741' style='height:12px' value='Y' checked></td>
							<td class='th1' >0861</td>
							<td class='th2'  id='td_accName_741'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_741'></td>
							<td class='th4'  id='td_relname_741'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_741' value='22'>
						<input type='hidden' name='code_741' value='086100'><tr id='tr_742' onClick="goDetail('086200',742)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_742' id='chk_742' style='height:12px' value='Y' checked></td>
							<td class='th1' >0862</td>
							<td class='th2'  id='td_accName_742'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_742'></td>
							<td class='th4'  id='td_relname_742'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_742' value='22'>
						<input type='hidden' name='code_742' value='086200'><tr id='tr_743' onClick="goDetail('086300',743)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_743' id='chk_743' style='height:12px' value='Y' checked></td>
							<td class='th1' >0863</td>
							<td class='th2'  id='td_accName_743'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_743'></td>
							<td class='th4'  id='td_relname_743'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_743' value='22'>
						<input type='hidden' name='code_743' value='086300'><tr id='tr_744' onClick="goDetail('086400',744)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_744' id='chk_744' style='height:12px' value='Y' checked></td>
							<td class='th1' >0864</td>
							<td class='th2'  id='td_accName_744'>&nbsp;사용자설정계정과목&nbsp; </td>
							<td class='th3'  id='td_chr_744'></td>
							<td class='th4'  id='td_relname_744'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_744' value='22'>
						<input type='hidden' name='code_744' value='086400'><tr id='tr_745' onClick="goDetail('086500',745)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_745' id='chk_745' style='height:12px' value='Y' checked></td>
							<td class='th1' >0865</td>
							<td class='th2'  id='td_accName_745'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_745'></td>
							<td class='th4'  id='td_relname_745'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_745' value='22'>
						<input type='hidden' name='code_745' value='086500'><tr id='tr_746' onClick="goDetail('086600',746)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_746' id='chk_746' style='height:12px' value='Y' checked></td>
							<td class='th1' >0866</td>
							<td class='th2'  id='td_accName_746'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_746'></td>
							<td class='th4'  id='td_relname_746'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_746' value='22'>
						<input type='hidden' name='code_746' value='086600'><tr id='tr_747' onClick="goDetail('086700',747)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_747' id='chk_747' style='height:12px' value='Y' checked></td>
							<td class='th1' >0867</td>
							<td class='th2'  id='td_accName_747'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_747'></td>
							<td class='th4'  id='td_relname_747'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_747' value='22'>
						<input type='hidden' name='code_747' value='086700'><tr id='tr_748' onClick="goDetail('086800',748)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_748' id='chk_748' style='height:12px' value='Y' checked></td>
							<td class='th1' >0868</td>
							<td class='th2'  id='td_accName_748'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_748'></td>
							<td class='th4'  id='td_relname_748'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_748' value='22'>
						<input type='hidden' name='code_748' value='086800'><tr id='tr_749' onClick="goDetail('086900',749)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_749' id='chk_749' style='height:12px' value='Y' checked></td>
							<td class='th1' >0869</td>
							<td class='th2'  id='td_accName_749'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_749'></td>
							<td class='th4'  id='td_relname_749'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_749' value='22'>
						<input type='hidden' name='code_749' value='086900'><tr id='tr_750' onClick="goDetail('087000',750)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_750' id='chk_750' style='height:12px' value='Y' checked></td>
							<td class='th1' >0870</td>
							<td class='th2'  id='td_accName_750'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_750'></td>
							<td class='th4'  id='td_relname_750'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_750' value='22'>
						<input type='hidden' name='code_750' value='087000'><tr id='tr_751' onClick="goDetail('087100',751)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_751' id='chk_751' style='height:12px' value='Y' checked></td>
							<td class='th1' >0871</td>
							<td class='th2'  id='td_accName_751'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_751'></td>
							<td class='th4'  id='td_relname_751'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_751' value='22'>
						<input type='hidden' name='code_751' value='087100'><tr id='tr_752' onClick="goDetail('087200',752)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_752' id='chk_752' style='height:12px' value='Y' checked></td>
							<td class='th1' >0872</td>
							<td class='th2'  id='td_accName_752'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_752'></td>
							<td class='th4'  id='td_relname_752'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_752' value='22'>
						<input type='hidden' name='code_752' value='087200'><tr id='tr_753' onClick="goDetail('087300',753)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_753' id='chk_753' style='height:12px' value='Y' checked></td>
							<td class='th1' >0873</td>
							<td class='th2'  id='td_accName_753'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_753'></td>
							<td class='th4'  id='td_relname_753'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_753' value='22'>
						<input type='hidden' name='code_753' value='087300'><tr id='tr_754' onClick="goDetail('087400',754)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_754' id='chk_754' style='height:12px' value='Y' checked></td>
							<td class='th1' >0874</td>
							<td class='th2'  id='td_accName_754'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_754'></td>
							<td class='th4'  id='td_relname_754'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_754' value='22'>
						<input type='hidden' name='code_754' value='087400'><tr id='tr_755' onClick="goDetail('087500',755)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_755' id='chk_755' style='height:12px' value='Y' checked></td>
							<td class='th1' >0875</td>
							<td class='th2'  id='td_accName_755'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_755'></td>
							<td class='th4'  id='td_relname_755'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_755' value='22'>
						<input type='hidden' name='code_755' value='087500'><tr id='tr_756' onClick="goDetail('087600',756)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_756' id='chk_756' style='height:12px' value='Y' checked></td>
							<td class='th1' >0876</td>
							<td class='th2'  id='td_accName_756'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_756'></td>
							<td class='th4'  id='td_relname_756'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_756' value='22'>
						<input type='hidden' name='code_756' value='087600'><tr id='tr_757' onClick="goDetail('087700',757)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_757' id='chk_757' style='height:12px' value='Y' checked></td>
							<td class='th1' >0877</td>
							<td class='th2'  id='td_accName_757'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_757'></td>
							<td class='th4'  id='td_relname_757'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_757' value='22'>
						<input type='hidden' name='code_757' value='087700'><tr id='tr_758' onClick="goDetail('087800',758)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_758' id='chk_758' style='height:12px' value='Y' checked></td>
							<td class='th1' >0878</td>
							<td class='th2'  id='td_accName_758'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_758'></td>
							<td class='th4'  id='td_relname_758'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_758' value='22'>
						<input type='hidden' name='code_758' value='087800'><tr id='tr_759' onClick="goDetail('087900',759)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_759' id='chk_759' style='height:12px' value='Y' checked></td>
							<td class='th1' >0879</td>
							<td class='th2'  id='td_accName_759'>운용리스료 </td>
							<td class='th3'  id='td_chr_759'>3.경비</td>
							<td class='th4'  id='td_relname_759'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_759' value='22'>
						<input type='hidden' name='code_759' value='087900'><tr id='tr_760' onClick="goDetail('088000',760)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_760' id='chk_760' style='height:12px' value='Y' checked></td>
							<td class='th1' >0880</td>
							<td class='th2'  id='td_accName_760'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_760'></td>
							<td class='th4'  id='td_relname_760'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_760' value='22'>
						<input type='hidden' name='code_760' value='088000'><tr id='tr_761' onClick="goDetail('088100',761)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_761' id='chk_761' style='height:12px' value='Y' checked></td>
							<td class='th1' >0881</td>
							<td class='th2'  id='td_accName_761'>관리비 </td>
							<td class='th3'  id='td_chr_761'>3.경비</td>
							<td class='th4'  id='td_relname_761'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_761' value='22'>
						<input type='hidden' name='code_761' value='088100'><tr id='tr_762' onClick="goDetail('088200',762)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_762' id='chk_762' style='height:12px' value='Y' checked></td>
							<td class='th1' >0882</td>
							<td class='th2'  id='td_accName_762'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_762'></td>
							<td class='th4'  id='td_relname_762'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_762' value='22'>
						<input type='hidden' name='code_762' value='088200'><tr id='tr_763' onClick="goDetail('088300',763)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_763' id='chk_763' style='height:12px' value='Y' checked></td>
							<td class='th1' >0883</td>
							<td class='th2'  id='td_accName_763'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_763'></td>
							<td class='th4'  id='td_relname_763'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_763' value='22'>
						<input type='hidden' name='code_763' value='088300'><tr id='tr_764' onClick="goDetail('088400',764)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_764' id='chk_764' style='height:12px' value='Y' checked></td>
							<td class='th1' >0884</td>
							<td class='th2'  id='td_accName_764'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_764'></td>
							<td class='th4'  id='td_relname_764'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_764' value='22'>
						<input type='hidden' name='code_764' value='088400'><tr id='tr_765' onClick="goDetail('088500',765)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_765' id='chk_765' style='height:12px' value='Y' checked></td>
							<td class='th1' >0885</td>
							<td class='th2'  id='td_accName_765'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_765'></td>
							<td class='th4'  id='td_relname_765'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_765' value='22'>
						<input type='hidden' name='code_765' value='088500'><tr id='tr_766' onClick="goDetail('088600',766)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_766' id='chk_766' style='height:12px' value='Y' checked></td>
							<td class='th1' >0886</td>
							<td class='th2'  id='td_accName_766'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_766'></td>
							<td class='th4'  id='td_relname_766'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_766' value='22'>
						<input type='hidden' name='code_766' value='088600'><tr id='tr_767' onClick="goDetail('088700',767)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_767' id='chk_767' style='height:12px' value='Y' checked></td>
							<td class='th1' >0887</td>
							<td class='th2'  id='td_accName_767'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_767'></td>
							<td class='th4'  id='td_relname_767'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_767' value='22'>
						<input type='hidden' name='code_767' value='088700'><tr id='tr_768' onClick="goDetail('088800',768)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_768' id='chk_768' style='height:12px' value='Y' checked></td>
							<td class='th1' >0888</td>
							<td class='th2'  id='td_accName_768'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_768'></td>
							<td class='th4'  id='td_relname_768'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_768' value='22'>
						<input type='hidden' name='code_768' value='088800'><tr id='tr_769' onClick="goDetail('088900',769)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_769' id='chk_769' style='height:12px' value='Y' checked></td>
							<td class='th1' >0889</td>
							<td class='th2'  id='td_accName_769'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_769'></td>
							<td class='th4'  id='td_relname_769'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_769' value='22'>
						<input type='hidden' name='code_769' value='088900'><tr id='tr_770' onClick="goDetail('089000',770)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_770' id='chk_770' style='height:12px' value='Y' checked></td>
							<td class='th1' >0890</td>
							<td class='th2'  id='td_accName_770'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_770'></td>
							<td class='th4'  id='td_relname_770'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_770' value='22'>
						<input type='hidden' name='code_770' value='089000'><tr id='tr_771' onClick="goDetail('089100',771)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_771' id='chk_771' style='height:12px' value='Y' checked></td>
							<td class='th1' >0891</td>
							<td class='th2'  id='td_accName_771'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_771'></td>
							<td class='th4'  id='td_relname_771'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_771' value='22'>
						<input type='hidden' name='code_771' value='089100'><tr id='tr_772' onClick="goDetail('089200',772)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_772' id='chk_772' style='height:12px' value='Y' checked></td>
							<td class='th1' >0892</td>
							<td class='th2'  id='td_accName_772'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_772'></td>
							<td class='th4'  id='td_relname_772'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_772' value='22'>
						<input type='hidden' name='code_772' value='089200'><tr id='tr_773' onClick="goDetail('089300',773)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_773' id='chk_773' style='height:12px' value='Y' checked></td>
							<td class='th1' >0893</td>
							<td class='th2'  id='td_accName_773'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_773'></td>
							<td class='th4'  id='td_relname_773'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_773' value='22'>
						<input type='hidden' name='code_773' value='089300'><tr id='tr_774' onClick="goDetail('089400',774)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_774' id='chk_774' style='height:12px' value='Y' checked></td>
							<td class='th1' >0894</td>
							<td class='th2'  id='td_accName_774'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_774'></td>
							<td class='th4'  id='td_relname_774'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_774' value='22'>
						<input type='hidden' name='code_774' value='089400'><tr id='tr_775' onClick="goDetail('089500',775)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_775' id='chk_775' style='height:12px' value='Y' checked></td>
							<td class='th1' >0895</td>
							<td class='th2'  id='td_accName_775'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_775'></td>
							<td class='th4'  id='td_relname_775'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_775' value='22'>
						<input type='hidden' name='code_775' value='089500'><tr id='tr_776' onClick="goDetail('089600',776)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_776' id='chk_776' style='height:12px' value='Y' checked></td>
							<td class='th1' >0896</td>
							<td class='th2'  id='td_accName_776'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_776'></td>
							<td class='th4'  id='td_relname_776'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_776' value='22'>
						<input type='hidden' name='code_776' value='089600'><tr id='tr_777' onClick="goDetail('089700',777)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_777' id='chk_777' style='height:12px' value='Y' checked></td>
							<td class='th1' >0897</td>
							<td class='th2'  id='td_accName_777'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_777'></td>
							<td class='th4'  id='td_relname_777'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_777' value='22'>
						<input type='hidden' name='code_777' value='089700'><tr id='tr_778' onClick="goDetail('089800',778)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_778' id='chk_778' style='height:12px' value='Y' checked></td>
							<td class='th1' >0898</td>
							<td class='th2'  id='td_accName_778'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_778'></td>
							<td class='th4'  id='td_relname_778'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_778' value='22'>
						<input type='hidden' name='code_778' value='089800'><tr id='tr_779' onClick="goDetail('089900',779)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_779' id='chk_779' style='height:12px' value='Y' checked></td>
							<td class='th1' >0899</td>
							<td class='th2'  id='td_accName_779'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_779'></td>
							<td class='th4'  id='td_relname_779'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_779' value='22'>
						<input type='hidden' name='code_779' value='089900'><tr id='tr_780' onClick="goDetail('090000',780)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_780' id='chk_780' style='height:12px' value='Y' checked></td>
							<td class='th1' >0900</td>
							<td class='th2'  id='td_accName_780'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_780'></td>
							<td class='th4'  id='td_relname_780'>판매관리비</td>
						</tr>
						<input type='hidden' id='Scode_780' value='22'>
						<input type='hidden' name='code_780' value='090000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_23' id='S_23' style='height:12px' value='Y' onClick="chk_Scode('23')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='23'>영업외수익</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_781' onClick="goDetail('090100',781)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_781' id='chk_781' style='height:12px' value='Y' checked></td>
							<td class='th1' >0901</td>
							<td class='th2'  id='td_accName_781'>이자수익 </td>
							<td class='th3'  id='td_chr_781'>1.수입이자</td>
							<td class='th4'  id='td_relname_781'></td>
						</tr>
						<input type='hidden' id='Scode_781' value='23'>
						<input type='hidden' name='code_781' value='090100'><tr id='tr_782' onClick="goDetail('090200',782)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_782' id='chk_782' style='height:12px' value='Y' checked></td>
							<td class='th1' >0902</td>
							<td class='th2'  id='td_accName_782'>만기보유증권이자 </td>
							<td class='th3'  id='td_chr_782'>1.수입이자</td>
							<td class='th4'  id='td_relname_782'></td>
						</tr>
						<input type='hidden' id='Scode_782' value='23'>
						<input type='hidden' name='code_782' value='090200'><tr id='tr_783' onClick="goDetail('090300',783)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_783' id='chk_783' style='height:12px' value='Y' checked></td>
							<td class='th1' >0903</td>
							<td class='th2'  id='td_accName_783'>배당금수익 </td>
							<td class='th3'  id='td_chr_783'>2.일반</td>
							<td class='th4'  id='td_relname_783'></td>
						</tr>
						<input type='hidden' id='Scode_783' value='23'>
						<input type='hidden' name='code_783' value='090300'><tr id='tr_784' onClick="goDetail('090400',784)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_784' id='chk_784' style='height:12px' value='Y' checked></td>
							<td class='th1' >0904</td>
							<td class='th2'  id='td_accName_784'>임대료수익 </td>
							<td class='th3'  id='td_chr_784'>2.일반</td>
							<td class='th4'  id='td_relname_784'></td>
						</tr>
						<input type='hidden' id='Scode_784' value='23'>
						<input type='hidden' name='code_784' value='090400'><tr id='tr_785' onClick="goDetail('090500',785)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_785' id='chk_785' style='height:12px' value='Y' checked></td>
							<td class='th1' >0905</td>
							<td class='th2'  id='td_accName_785'>단기매매증권평가이익 </td>
							<td class='th3'  id='td_chr_785'>2.일반</td>
							<td class='th4'  id='td_relname_785'></td>
						</tr>
						<input type='hidden' id='Scode_785' value='23'>
						<input type='hidden' name='code_785' value='090500'><tr id='tr_786' onClick="goDetail('090600',786)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_786' id='chk_786' style='height:12px' value='Y' checked></td>
							<td class='th1' >0906</td>
							<td class='th2'  id='td_accName_786'>단기매매증권처분이익 </td>
							<td class='th3'  id='td_chr_786'>2.일반</td>
							<td class='th4'  id='td_relname_786'></td>
						</tr>
						<input type='hidden' id='Scode_786' value='23'>
						<input type='hidden' name='code_786' value='090600'><tr id='tr_787' onClick="goDetail('090700',787)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_787' id='chk_787' style='height:12px' value='Y' checked></td>
							<td class='th1' >0907</td>
							<td class='th2'  id='td_accName_787'>외환차익 </td>
							<td class='th3'  id='td_chr_787'>2.일반</td>
							<td class='th4'  id='td_relname_787'></td>
						</tr>
						<input type='hidden' id='Scode_787' value='23'>
						<input type='hidden' name='code_787' value='090700'><tr id='tr_788' onClick="goDetail('090800',788)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_788' id='chk_788' style='height:12px' value='Y' checked></td>
							<td class='th1' >0908</td>
							<td class='th2'  id='td_accName_788'>대손충당금환입 </td>
							<td class='th3'  id='td_chr_788'>2.일반</td>
							<td class='th4'  id='td_relname_788'></td>
						</tr>
						<input type='hidden' id='Scode_788' value='23'>
						<input type='hidden' name='code_788' value='090800'><tr id='tr_789' onClick="goDetail('090900',789)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_789' id='chk_789' style='height:12px' value='Y' checked></td>
							<td class='th1' >0909</td>
							<td class='th2'  id='td_accName_789'>수수료수익 </td>
							<td class='th3'  id='td_chr_789'>2.일반</td>
							<td class='th4'  id='td_relname_789'></td>
						</tr>
						<input type='hidden' id='Scode_789' value='23'>
						<input type='hidden' name='code_789' value='090900'><tr id='tr_790' onClick="goDetail('091000',790)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_790' id='chk_790' style='height:12px' value='Y' checked></td>
							<td class='th1' >0910</td>
							<td class='th2'  id='td_accName_790'>외화환산이익 </td>
							<td class='th3'  id='td_chr_790'>2.일반</td>
							<td class='th4'  id='td_relname_790'></td>
						</tr>
						<input type='hidden' id='Scode_790' value='23'>
						<input type='hidden' name='code_790' value='091000'><tr id='tr_791' onClick="goDetail('091100',791)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_791' id='chk_791' style='height:12px' value='Y' checked></td>
							<td class='th1' >0911</td>
							<td class='th2'  id='td_accName_791'>사채상환이익 </td>
							<td class='th3'  id='td_chr_791'>2.일반</td>
							<td class='th4'  id='td_relname_791'></td>
						</tr>
						<input type='hidden' id='Scode_791' value='23'>
						<input type='hidden' name='code_791' value='091100'><tr id='tr_792' onClick="goDetail('091200',792)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_792' id='chk_792' style='height:12px' value='Y' checked></td>
							<td class='th1' >0912</td>
							<td class='th2'  id='td_accName_792'>전기오류수정이익 </td>
							<td class='th3'  id='td_chr_792'>2.일반</td>
							<td class='th4'  id='td_relname_792'></td>
						</tr>
						<input type='hidden' id='Scode_792' value='23'>
						<input type='hidden' name='code_792' value='091200'><tr id='tr_793' onClick="goDetail('091300',793)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_793' id='chk_793' style='height:12px' value='Y' checked></td>
							<td class='th1' >0913</td>
							<td class='th2'  id='td_accName_793'>하자보수충당금환입 </td>
							<td class='th3'  id='td_chr_793'>2.일반</td>
							<td class='th4'  id='td_relname_793'></td>
						</tr>
						<input type='hidden' id='Scode_793' value='23'>
						<input type='hidden' name='code_793' value='091300'><tr id='tr_794' onClick="goDetail('091400',794)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_794' id='chk_794' style='height:12px' value='Y' checked></td>
							<td class='th1' >0914</td>
							<td class='th2'  id='td_accName_794'>유형자산처분이익 </td>
							<td class='th3'  id='td_chr_794'>2.일반</td>
							<td class='th4'  id='td_relname_794'></td>
						</tr>
						<input type='hidden' id='Scode_794' value='23'>
						<input type='hidden' name='code_794' value='091400'><tr id='tr_795' onClick="goDetail('091500',795)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_795' id='chk_795' style='height:12px' value='Y' checked></td>
							<td class='th1' >0915</td>
							<td class='th2'  id='td_accName_795'>매도가능증권처분이익 </td>
							<td class='th3'  id='td_chr_795'>2.일반</td>
							<td class='th4'  id='td_relname_795'></td>
						</tr>
						<input type='hidden' id='Scode_795' value='23'>
						<input type='hidden' name='code_795' value='091500'><tr id='tr_796' onClick="goDetail('091600',796)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_796' id='chk_796' style='height:12px' value='Y' checked></td>
							<td class='th1' >0916</td>
							<td class='th2'  id='td_accName_796'>상각채권추심이익 </td>
							<td class='th3'  id='td_chr_796'>2.일반</td>
							<td class='th4'  id='td_relname_796'></td>
						</tr>
						<input type='hidden' id='Scode_796' value='23'>
						<input type='hidden' name='code_796' value='091600'><tr id='tr_797' onClick="goDetail('091700',797)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_797' id='chk_797' style='height:12px' value='Y' checked></td>
							<td class='th1' >0917</td>
							<td class='th2'  id='td_accName_797'>자산수증이익 </td>
							<td class='th3'  id='td_chr_797'>2.일반</td>
							<td class='th4'  id='td_relname_797'></td>
						</tr>
						<input type='hidden' id='Scode_797' value='23'>
						<input type='hidden' name='code_797' value='091700'><tr id='tr_798' onClick="goDetail('091800',798)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_798' id='chk_798' style='height:12px' value='Y' checked></td>
							<td class='th1' >0918</td>
							<td class='th2'  id='td_accName_798'>채무면제이익 </td>
							<td class='th3'  id='td_chr_798'>2.일반</td>
							<td class='th4'  id='td_relname_798'></td>
						</tr>
						<input type='hidden' id='Scode_798' value='23'>
						<input type='hidden' name='code_798' value='091800'><tr id='tr_799' onClick="goDetail('091900',799)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_799' id='chk_799' style='height:12px' value='Y' checked></td>
							<td class='th1' >0919</td>
							<td class='th2'  id='td_accName_799'>보험차익 </td>
							<td class='th3'  id='td_chr_799'>2.일반</td>
							<td class='th4'  id='td_relname_799'></td>
						</tr>
						<input type='hidden' id='Scode_799' value='23'>
						<input type='hidden' name='code_799' value='091900'><tr id='tr_800' onClick="goDetail('092000',800)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_800' id='chk_800' style='height:12px' value='Y' checked></td>
							<td class='th1' >0920</td>
							<td class='th2'  id='td_accName_800'>투자증권손상차환입 </td>
							<td class='th3'  id='td_chr_800'>2.일반</td>
							<td class='th4'  id='td_relname_800'></td>
						</tr>
						<input type='hidden' id='Scode_800' value='23'>
						<input type='hidden' name='code_800' value='092000'><tr id='tr_801' onClick="goDetail('092100',801)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_801' id='chk_801' style='height:12px' value='Y' checked></td>
							<td class='th1' >0921</td>
							<td class='th2'  id='td_accName_801'>지분법이익 </td>
							<td class='th3'  id='td_chr_801'>2.일반</td>
							<td class='th4'  id='td_relname_801'></td>
						</tr>
						<input type='hidden' id='Scode_801' value='23'>
						<input type='hidden' name='code_801' value='092100'><tr id='tr_802' onClick="goDetail('092200',802)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_802' id='chk_802' style='height:12px' value='Y' checked></td>
							<td class='th1' >0922</td>
							<td class='th2'  id='td_accName_802'>만기보유증권처분이익 </td>
							<td class='th3'  id='td_chr_802'>2.일반</td>
							<td class='th4'  id='td_relname_802'></td>
						</tr>
						<input type='hidden' id='Scode_802' value='23'>
						<input type='hidden' name='code_802' value='092200'><tr id='tr_803' onClick="goDetail('092300',803)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_803' id='chk_803' style='height:12px' value='Y' checked></td>
							<td class='th1' >0923</td>
							<td class='th2'  id='td_accName_803'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_803'></td>
							<td class='th4'  id='td_relname_803'></td>
						</tr>
						<input type='hidden' id='Scode_803' value='23'>
						<input type='hidden' name='code_803' value='092300'><tr id='tr_804' onClick="goDetail('092400',804)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_804' id='chk_804' style='height:12px' value='Y' checked></td>
							<td class='th1' >0924</td>
							<td class='th2'  id='td_accName_804'>중소투자준비금환입 </td>
							<td class='th3'  id='td_chr_804'>4.준비금환입</td>
							<td class='th4'  id='td_relname_804'>중소기업투자준비금</td>
						</tr>
						<input type='hidden' id='Scode_804' value='23'>
						<input type='hidden' name='code_804' value='092400'><tr id='tr_805' onClick="goDetail('092500',805)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_805' id='chk_805' style='height:12px' value='Y' checked></td>
							<td class='th1' >0925</td>
							<td class='th2'  id='td_accName_805'>연구개발준비금환입 </td>
							<td class='th3'  id='td_chr_805'>4.준비금환입</td>
							<td class='th4'  id='td_relname_805'>연구인력개발준비금</td>
						</tr>
						<input type='hidden' id='Scode_805' value='23'>
						<input type='hidden' name='code_805' value='092500'><tr id='tr_806' onClick="goDetail('092600',806)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_806' id='chk_806' style='height:12px' value='Y' checked></td>
							<td class='th1' >0926</td>
							<td class='th2'  id='td_accName_806'>해외개척준비금환입 </td>
							<td class='th3'  id='td_chr_806'>4.준비금환입</td>
							<td class='th4'  id='td_relname_806'>해외시장개척준비금</td>
						</tr>
						<input type='hidden' id='Scode_806' value='23'>
						<input type='hidden' name='code_806' value='092600'><tr id='tr_807' onClick="goDetail('092700',807)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_807' id='chk_807' style='height:12px' value='Y' checked></td>
							<td class='th1' >0927</td>
							<td class='th2'  id='td_accName_807'>지방이전준비금환입 </td>
							<td class='th3'  id='td_chr_807'>4.준비금환입</td>
							<td class='th4'  id='td_relname_807'>지방이전준비금</td>
						</tr>
						<input type='hidden' id='Scode_807' value='23'>
						<input type='hidden' name='code_807' value='092700'><tr id='tr_808' onClick="goDetail('092800',808)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_808' id='chk_808' style='height:12px' value='Y' checked></td>
							<td class='th1' >0928</td>
							<td class='th2'  id='td_accName_808'>수출손실준비금환입 </td>
							<td class='th3'  id='td_chr_808'>4.준비금환입</td>
							<td class='th4'  id='td_relname_808'>수출손실준비금</td>
						</tr>
						<input type='hidden' id='Scode_808' value='23'>
						<input type='hidden' name='code_808' value='092800'><tr id='tr_809' onClick="goDetail('092900',809)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_809' id='chk_809' style='height:12px' value='Y' checked></td>
							<td class='th1' >0929</td>
							<td class='th2'  id='td_accName_809'>재평가이익 </td>
							<td class='th3'  id='td_chr_809'>2.일반</td>
							<td class='th4'  id='td_relname_809'></td>
						</tr>
						<input type='hidden' id='Scode_809' value='23'>
						<input type='hidden' name='code_809' value='092900'><tr id='tr_810' onClick="goDetail('093000',810)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_810' id='chk_810' style='height:12px' value='Y' checked></td>
							<td class='th1' >0930</td>
							<td class='th2'  id='td_accName_810'>잡이익 </td>
							<td class='th3'  id='td_chr_810'>2.일반</td>
							<td class='th4'  id='td_relname_810'></td>
						</tr>
						<input type='hidden' id='Scode_810' value='23'>
						<input type='hidden' name='code_810' value='093000'><tr id='tr_811' onClick="goDetail('093100',811)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_811' id='chk_811' style='height:12px' value='Y' checked></td>
							<td class='th1' >0931</td>
							<td class='th2'  id='td_accName_811'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_811'></td>
							<td class='th4'  id='td_relname_811'></td>
						</tr>
						<input type='hidden' id='Scode_811' value='23'>
						<input type='hidden' name='code_811' value='093100'><tr id='tr_812' onClick="goDetail('093200',812)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_812' id='chk_812' style='height:12px' value='Y' checked></td>
							<td class='th1' >0932</td>
							<td class='th2'  id='td_accName_812'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_812'></td>
							<td class='th4'  id='td_relname_812'></td>
						</tr>
						<input type='hidden' id='Scode_812' value='23'>
						<input type='hidden' name='code_812' value='093200'><tr id='tr_813' onClick="goDetail('093300',813)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_813' id='chk_813' style='height:12px' value='Y' checked></td>
							<td class='th1' >0933</td>
							<td class='th2'  id='td_accName_813'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_813'></td>
							<td class='th4'  id='td_relname_813'></td>
						</tr>
						<input type='hidden' id='Scode_813' value='23'>
						<input type='hidden' name='code_813' value='093300'><tr id='tr_814' onClick="goDetail('093400',814)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_814' id='chk_814' style='height:12px' value='Y' checked></td>
							<td class='th1' >0934</td>
							<td class='th2'  id='td_accName_814'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_814'></td>
							<td class='th4'  id='td_relname_814'></td>
						</tr>
						<input type='hidden' id='Scode_814' value='23'>
						<input type='hidden' name='code_814' value='093400'><tr id='tr_815' onClick="goDetail('093500',815)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_815' id='chk_815' style='height:12px' value='Y' checked></td>
							<td class='th1' >0935</td>
							<td class='th2'  id='td_accName_815'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_815'></td>
							<td class='th4'  id='td_relname_815'></td>
						</tr>
						<input type='hidden' id='Scode_815' value='23'>
						<input type='hidden' name='code_815' value='093500'><tr id='tr_816' onClick="goDetail('093600',816)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_816' id='chk_816' style='height:12px' value='Y' checked></td>
							<td class='th1' >0936</td>
							<td class='th2'  id='td_accName_816'>법인세환급액 </td>
							<td class='th3'  id='td_chr_816'></td>
							<td class='th4'  id='td_relname_816'></td>
						</tr>
						<input type='hidden' id='Scode_816' value='23'>
						<input type='hidden' name='code_816' value='093600'><tr id='tr_817' onClick="goDetail('093700',817)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_817' id='chk_817' style='height:12px' value='Y' checked></td>
							<td class='th1' >0937</td>
							<td class='th2'  id='td_accName_817'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_817'></td>
							<td class='th4'  id='td_relname_817'></td>
						</tr>
						<input type='hidden' id='Scode_817' value='23'>
						<input type='hidden' name='code_817' value='093700'><tr id='tr_818' onClick="goDetail('093800',818)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_818' id='chk_818' style='height:12px' value='Y' checked></td>
							<td class='th1' >0938</td>
							<td class='th2'  id='td_accName_818'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_818'></td>
							<td class='th4'  id='td_relname_818'></td>
						</tr>
						<input type='hidden' id='Scode_818' value='23'>
						<input type='hidden' name='code_818' value='093800'><tr id='tr_819' onClick="goDetail('093900',819)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_819' id='chk_819' style='height:12px' value='Y' checked></td>
							<td class='th1' >0939</td>
							<td class='th2'  id='td_accName_819'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_819'></td>
							<td class='th4'  id='td_relname_819'></td>
						</tr>
						<input type='hidden' id='Scode_819' value='23'>
						<input type='hidden' name='code_819' value='093900'><tr id='tr_820' onClick="goDetail('094000',820)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_820' id='chk_820' style='height:12px' value='Y' checked></td>
							<td class='th1' >0940</td>
							<td class='th2'  id='td_accName_820'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_820'></td>
							<td class='th4'  id='td_relname_820'></td>
						</tr>
						<input type='hidden' id='Scode_820' value='23'>
						<input type='hidden' name='code_820' value='094000'><tr id='tr_821' onClick="goDetail('094100',821)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_821' id='chk_821' style='height:12px' value='Y' checked></td>
							<td class='th1' >0941</td>
							<td class='th2'  id='td_accName_821'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_821'></td>
							<td class='th4'  id='td_relname_821'></td>
						</tr>
						<input type='hidden' id='Scode_821' value='23'>
						<input type='hidden' name='code_821' value='094100'><tr id='tr_822' onClick="goDetail('094200',822)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_822' id='chk_822' style='height:12px' value='Y' checked></td>
							<td class='th1' >0942</td>
							<td class='th2'  id='td_accName_822'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_822'></td>
							<td class='th4'  id='td_relname_822'></td>
						</tr>
						<input type='hidden' id='Scode_822' value='23'>
						<input type='hidden' name='code_822' value='094200'><tr id='tr_823' onClick="goDetail('094300',823)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_823' id='chk_823' style='height:12px' value='Y' checked></td>
							<td class='th1' >0943</td>
							<td class='th2'  id='td_accName_823'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_823'></td>
							<td class='th4'  id='td_relname_823'></td>
						</tr>
						<input type='hidden' id='Scode_823' value='23'>
						<input type='hidden' name='code_823' value='094300'><tr id='tr_824' onClick="goDetail('094400',824)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_824' id='chk_824' style='height:12px' value='Y' checked></td>
							<td class='th1' >0944</td>
							<td class='th2'  id='td_accName_824'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_824'></td>
							<td class='th4'  id='td_relname_824'></td>
						</tr>
						<input type='hidden' id='Scode_824' value='23'>
						<input type='hidden' name='code_824' value='094400'><tr id='tr_825' onClick="goDetail('094500',825)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_825' id='chk_825' style='height:12px' value='Y' checked></td>
							<td class='th1' >0945</td>
							<td class='th2'  id='td_accName_825'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_825'></td>
							<td class='th4'  id='td_relname_825'></td>
						</tr>
						<input type='hidden' id='Scode_825' value='23'>
						<input type='hidden' name='code_825' value='094500'><tr id='tr_826' onClick="goDetail('094600',826)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_826' id='chk_826' style='height:12px' value='Y' checked></td>
							<td class='th1' >0946</td>
							<td class='th2'  id='td_accName_826'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_826'></td>
							<td class='th4'  id='td_relname_826'></td>
						</tr>
						<input type='hidden' id='Scode_826' value='23'>
						<input type='hidden' name='code_826' value='094600'><tr id='tr_827' onClick="goDetail('094700',827)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_827' id='chk_827' style='height:12px' value='Y' checked></td>
							<td class='th1' >0947</td>
							<td class='th2'  id='td_accName_827'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_827'></td>
							<td class='th4'  id='td_relname_827'></td>
						</tr>
						<input type='hidden' id='Scode_827' value='23'>
						<input type='hidden' name='code_827' value='094700'><tr id='tr_828' onClick="goDetail('094800',828)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_828' id='chk_828' style='height:12px' value='Y' checked></td>
							<td class='th1' >0948</td>
							<td class='th2'  id='td_accName_828'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_828'></td>
							<td class='th4'  id='td_relname_828'></td>
						</tr>
						<input type='hidden' id='Scode_828' value='23'>
						<input type='hidden' name='code_828' value='094800'><tr id='tr_829' onClick="goDetail('094900',829)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_829' id='chk_829' style='height:12px' value='Y' checked></td>
							<td class='th1' >0949</td>
							<td class='th2'  id='td_accName_829'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_829'></td>
							<td class='th4'  id='td_relname_829'></td>
						</tr>
						<input type='hidden' id='Scode_829' value='23'>
						<input type='hidden' name='code_829' value='094900'><tr id='tr_830' onClick="goDetail('095000',830)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_830' id='chk_830' style='height:12px' value='Y' checked></td>
							<td class='th1' >0950</td>
							<td class='th2'  id='td_accName_830'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_830'></td>
							<td class='th4'  id='td_relname_830'></td>
						</tr>
						<input type='hidden' id='Scode_830' value='23'>
						<input type='hidden' name='code_830' value='095000'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_24' id='S_24' style='height:12px' value='Y' onClick="chk_Scode('24')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='24'>영업외비용</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_831' onClick="goDetail('095100',831)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_831' id='chk_831' style='height:12px' value='Y' checked></td>
							<td class='th1' >0951</td>
							<td class='th2'  id='td_accName_831'>이자비용 </td>
							<td class='th3'  id='td_chr_831'>1.지급이자</td>
							<td class='th4'  id='td_relname_831'></td>
						</tr>
						<input type='hidden' id='Scode_831' value='24'>
						<input type='hidden' name='code_831' value='095100'><tr id='tr_832' onClick="goDetail('095200',832)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_832' id='chk_832' style='height:12px' value='Y' checked></td>
							<td class='th1' >0952</td>
							<td class='th2'  id='td_accName_832'>외환차손 </td>
							<td class='th3'  id='td_chr_832'>2.일반</td>
							<td class='th4'  id='td_relname_832'></td>
						</tr>
						<input type='hidden' id='Scode_832' value='24'>
						<input type='hidden' name='code_832' value='095200'><tr id='tr_833' onClick="goDetail('095300',833)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_833' id='chk_833' style='height:12px' value='Y' checked></td>
							<td class='th1' >0953</td>
							<td class='th2'  id='td_accName_833'>기부금 </td>
							<td class='th3'  id='td_chr_833'>2.일반</td>
							<td class='th4'  id='td_relname_833'></td>
						</tr>
						<input type='hidden' id='Scode_833' value='24'>
						<input type='hidden' name='code_833' value='095300'><tr id='tr_834' onClick="goDetail('095400',834)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_834' id='chk_834' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0954</td>
							<td class='th2' style='color:#ec4261' id='td_accName_834'>기타의대손상각비 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_834'>2.일반</td>
							<td class='th4' style='color:#ec4261' id='td_relname_834'></td>
						</tr>
						<input type='hidden' id='Scode_834' value='24'>
						<input type='hidden' name='code_834' value='095400'><tr id='tr_835' onClick="goDetail('095500',835)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_835' id='chk_835' style='height:12px' value='Y' checked></td>
							<td class='th1' >0955</td>
							<td class='th2'  id='td_accName_835'>외화환산손실 </td>
							<td class='th3'  id='td_chr_835'>2.일반</td>
							<td class='th4'  id='td_relname_835'></td>
						</tr>
						<input type='hidden' id='Scode_835' value='24'>
						<input type='hidden' name='code_835' value='095500'><tr id='tr_836' onClick="goDetail('095600',836)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_836' id='chk_836' style='height:12px' value='Y' checked></td>
							<td class='th1' >0956</td>
							<td class='th2'  id='td_accName_836'>매출채권처분손실 </td>
							<td class='th3'  id='td_chr_836'>2.일반</td>
							<td class='th4'  id='td_relname_836'></td>
						</tr>
						<input type='hidden' id='Scode_836' value='24'>
						<input type='hidden' name='code_836' value='095600'><tr id='tr_837' onClick="goDetail('095700',837)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_837' id='chk_837' style='height:12px' value='Y' checked></td>
							<td class='th1' >0957</td>
							<td class='th2'  id='td_accName_837'>단기매매증권평가손실 </td>
							<td class='th3'  id='td_chr_837'>2.일반</td>
							<td class='th4'  id='td_relname_837'></td>
						</tr>
						<input type='hidden' id='Scode_837' value='24'>
						<input type='hidden' name='code_837' value='095700'><tr id='tr_838' onClick="goDetail('095800',838)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_838' id='chk_838' style='height:12px' value='Y' checked></td>
							<td class='th1' >0958</td>
							<td class='th2'  id='td_accName_838'>단기매매증권처분손실 </td>
							<td class='th3'  id='td_chr_838'>2.일반</td>
							<td class='th4'  id='td_relname_838'></td>
						</tr>
						<input type='hidden' id='Scode_838' value='24'>
						<input type='hidden' name='code_838' value='095800'><tr id='tr_839' onClick="goDetail('095900',839)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_839' id='chk_839' style='height:12px' value='Y' checked></td>
							<td class='th1' >0959</td>
							<td class='th2'  id='td_accName_839'>재고자산감모손실 </td>
							<td class='th3'  id='td_chr_839'>2.일반</td>
							<td class='th4'  id='td_relname_839'></td>
						</tr>
						<input type='hidden' id='Scode_839' value='24'>
						<input type='hidden' name='code_839' value='095900'><tr id='tr_840' onClick="goDetail('096000',840)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_840' id='chk_840' style='height:12px' value='Y' checked></td>
							<td class='th1' >0960</td>
							<td class='th2'  id='td_accName_840'>재고자산평가손실 </td>
							<td class='th3'  id='td_chr_840'>2.일반</td>
							<td class='th4'  id='td_relname_840'></td>
						</tr>
						<input type='hidden' id='Scode_840' value='24'>
						<input type='hidden' name='code_840' value='096000'><tr id='tr_841' onClick="goDetail('096100',841)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_841' id='chk_841' style='height:12px' value='Y' checked></td>
							<td class='th1' >0961</td>
							<td class='th2'  id='td_accName_841'>재해손실 </td>
							<td class='th3'  id='td_chr_841'>2.일반</td>
							<td class='th4'  id='td_relname_841'></td>
						</tr>
						<input type='hidden' id='Scode_841' value='24'>
						<input type='hidden' name='code_841' value='096100'><tr id='tr_842' onClick="goDetail('096200',842)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_842' id='chk_842' style='height:12px' value='Y' checked></td>
							<td class='th1' >0962</td>
							<td class='th2'  id='td_accName_842'>전기오류수정손실 </td>
							<td class='th3'  id='td_chr_842'>2.일반</td>
							<td class='th4'  id='td_relname_842'></td>
						</tr>
						<input type='hidden' id='Scode_842' value='24'>
						<input type='hidden' name='code_842' value='096200'><tr id='tr_843' onClick="goDetail('096300',843)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_843' id='chk_843' style='height:12px' value='Y' checked></td>
							<td class='th1' >0963</td>
							<td class='th2'  id='td_accName_843'>투자증권손상차손 </td>
							<td class='th3'  id='td_chr_843'>2.일반</td>
							<td class='th4'  id='td_relname_843'></td>
						</tr>
						<input type='hidden' id='Scode_843' value='24'>
						<input type='hidden' name='code_843' value='096300'><tr id='tr_844' onClick="goDetail('096400',844)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_844' id='chk_844' style='height:12px' value='Y' checked></td>
							<td class='th1' >0964</td>
							<td class='th2'  id='td_accName_844'>지분법손실 </td>
							<td class='th3'  id='td_chr_844'>2.일반</td>
							<td class='th4'  id='td_relname_844'></td>
						</tr>
						<input type='hidden' id='Scode_844' value='24'>
						<input type='hidden' name='code_844' value='096400'><tr id='tr_845' onClick="goDetail('096500',845)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_845' id='chk_845' style='height:12px' value='Y' checked></td>
							<td class='th1' >0965</td>
							<td class='th2'  id='td_accName_845'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_845'>2.일반</td>
							<td class='th4'  id='td_relname_845'></td>
						</tr>
						<input type='hidden' id='Scode_845' value='24'>
						<input type='hidden' name='code_845' value='096500'><tr id='tr_846' onClick="goDetail('096600',846)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_846' id='chk_846' style='height:12px' value='Y' checked></td>
							<td class='th1' >0966</td>
							<td class='th2'  id='td_accName_846'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_846'>2.일반</td>
							<td class='th4'  id='td_relname_846'></td>
						</tr>
						<input type='hidden' id='Scode_846' value='24'>
						<input type='hidden' name='code_846' value='096600'><tr id='tr_847' onClick="goDetail('096700',847)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_847' id='chk_847' style='height:12px' value='Y' checked></td>
							<td class='th1' >0967</td>
							<td class='th2'  id='td_accName_847'>회사채이자 </td>
							<td class='th3'  id='td_chr_847'>1.지급이자</td>
							<td class='th4'  id='td_relname_847'></td>
						</tr>
						<input type='hidden' id='Scode_847' value='24'>
						<input type='hidden' name='code_847' value='096700'><tr id='tr_848' onClick="goDetail('096800',848)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_848' id='chk_848' style='height:12px' value='Y' checked></td>
							<td class='th1' >0968</td>
							<td class='th2'  id='td_accName_848'>사채상환손실 </td>
							<td class='th3'  id='td_chr_848'>2.일반</td>
							<td class='th4'  id='td_relname_848'></td>
						</tr>
						<input type='hidden' id='Scode_848' value='24'>
						<input type='hidden' name='code_848' value='096800'><tr id='tr_849' onClick="goDetail('096900',849)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_849' id='chk_849' style='height:12px' value='Y' checked></td>
							<td class='th1' >0969</td>
							<td class='th2'  id='td_accName_849'>보상비 </td>
							<td class='th3'  id='td_chr_849'>2.일반</td>
							<td class='th4'  id='td_relname_849'></td>
						</tr>
						<input type='hidden' id='Scode_849' value='24'>
						<input type='hidden' name='code_849' value='096900'><tr id='tr_850' onClick="goDetail('097000',850)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_850' id='chk_850' style='height:12px' value='Y' checked></td>
							<td class='th1' >0970</td>
							<td class='th2'  id='td_accName_850'>유형자산처분손실 </td>
							<td class='th3'  id='td_chr_850'>2.일반</td>
							<td class='th4'  id='td_relname_850'></td>
						</tr>
						<input type='hidden' id='Scode_850' value='24'>
						<input type='hidden' name='code_850' value='097000'><tr id='tr_851' onClick="goDetail('097100',851)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_851' id='chk_851' style='height:12px' value='Y' checked></td>
							<td class='th1' >0971</td>
							<td class='th2'  id='td_accName_851'>매도가능증권처분손실 </td>
							<td class='th3'  id='td_chr_851'>2.일반</td>
							<td class='th4'  id='td_relname_851'></td>
						</tr>
						<input type='hidden' id='Scode_851' value='24'>
						<input type='hidden' name='code_851' value='097100'><tr id='tr_852' onClick="goDetail('097200',852)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_852' id='chk_852' style='height:12px' value='Y' checked></td>
							<td class='th1' >0972</td>
							<td class='th2'  id='td_accName_852'>중소투자준비금전입 </td>
							<td class='th3'  id='td_chr_852'>5.준비금전입</td>
							<td class='th4'  id='td_relname_852'>중소기업투자준비금</td>
						</tr>
						<input type='hidden' id='Scode_852' value='24'>
						<input type='hidden' name='code_852' value='097200'><tr id='tr_853' onClick="goDetail('097300',853)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_853' id='chk_853' style='height:12px' value='Y' checked></td>
							<td class='th1' >0973</td>
							<td class='th2'  id='td_accName_853'>연구개발준비금전입 </td>
							<td class='th3'  id='td_chr_853'>5.준비금전입</td>
							<td class='th4'  id='td_relname_853'>연구인력개발준비금</td>
						</tr>
						<input type='hidden' id='Scode_853' value='24'>
						<input type='hidden' name='code_853' value='097300'><tr id='tr_854' onClick="goDetail('097400',854)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_854' id='chk_854' style='height:12px' value='Y' checked></td>
							<td class='th1' >0974</td>
							<td class='th2'  id='td_accName_854'>해외개척준비금전입 </td>
							<td class='th3'  id='td_chr_854'>5.준비금전입</td>
							<td class='th4'  id='td_relname_854'>해외시장개척준비금</td>
						</tr>
						<input type='hidden' id='Scode_854' value='24'>
						<input type='hidden' name='code_854' value='097400'><tr id='tr_855' onClick="goDetail('097500',855)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_855' id='chk_855' style='height:12px' value='Y' checked></td>
							<td class='th1' >0975</td>
							<td class='th2'  id='td_accName_855'>지방이전준비금전입 </td>
							<td class='th3'  id='td_chr_855'>5.준비금전입</td>
							<td class='th4'  id='td_relname_855'>지방이전준비금</td>
						</tr>
						<input type='hidden' id='Scode_855' value='24'>
						<input type='hidden' name='code_855' value='097500'><tr id='tr_856' onClick="goDetail('097600',856)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_856' id='chk_856' style='height:12px' value='Y' checked></td>
							<td class='th1' >0976</td>
							<td class='th2'  id='td_accName_856'>수출손실준비금전입 </td>
							<td class='th3'  id='td_chr_856'>5.준비금전입</td>
							<td class='th4'  id='td_relname_856'>수출손실준비금</td>
						</tr>
						<input type='hidden' id='Scode_856' value='24'>
						<input type='hidden' name='code_856' value='097600'><tr id='tr_857' onClick="goDetail('097700',857)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_857' id='chk_857' style='height:12px' value='Y' checked></td>
							<td class='th1' >0977</td>
							<td class='th2'  id='td_accName_857'>특별상각 </td>
							<td class='th3'  id='td_chr_857'>6.특별상각</td>
							<td class='th4'  id='td_relname_857'></td>
						</tr>
						<input type='hidden' id='Scode_857' value='24'>
						<input type='hidden' name='code_857' value='097700'><tr id='tr_858' onClick="goDetail('097800',858)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_858' id='chk_858' style='height:12px' value='Y' checked></td>
							<td class='th1' >0978</td>
							<td class='th2'  id='td_accName_858'>만기보유증권처분손실 </td>
							<td class='th3'  id='td_chr_858'>2.일반</td>
							<td class='th4'  id='td_relname_858'></td>
						</tr>
						<input type='hidden' id='Scode_858' value='24'>
						<input type='hidden' name='code_858' value='097800'><tr id='tr_859' onClick="goDetail('097900',859)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_859' id='chk_859' style='height:12px' value='Y' checked></td>
							<td class='th1' >0979</td>
							<td class='th2'  id='td_accName_859'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_859'></td>
							<td class='th4'  id='td_relname_859'></td>
						</tr>
						<input type='hidden' id='Scode_859' value='24'>
						<input type='hidden' name='code_859' value='097900'><tr id='tr_860' onClick="goDetail('098000',860)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_860' id='chk_860' style='height:12px' value='Y' checked></td>
							<td class='th1' >0980</td>
							<td class='th2'  id='td_accName_860'>잡손실 </td>
							<td class='th3'  id='td_chr_860'>2.일반</td>
							<td class='th4'  id='td_relname_860'></td>
						</tr>
						<input type='hidden' id='Scode_860' value='24'>
						<input type='hidden' name='code_860' value='098000'><tr id='tr_861' onClick="goDetail('098100',861)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_861' id='chk_861' style='height:12px' value='Y' checked></td>
							<td class='th1' >0981</td>
							<td class='th2'  id='td_accName_861'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_861'></td>
							<td class='th4'  id='td_relname_861'></td>
						</tr>
						<input type='hidden' id='Scode_861' value='24'>
						<input type='hidden' name='code_861' value='098100'><tr id='tr_862' onClick="goDetail('098200',862)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_862' id='chk_862' style='height:12px' value='Y' checked></td>
							<td class='th1' >0982</td>
							<td class='th2'  id='td_accName_862'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_862'></td>
							<td class='th4'  id='td_relname_862'></td>
						</tr>
						<input type='hidden' id='Scode_862' value='24'>
						<input type='hidden' name='code_862' value='098200'><tr id='tr_863' onClick="goDetail('098300',863)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_863' id='chk_863' style='height:12px' value='Y' checked></td>
							<td class='th1' >0983</td>
							<td class='th2'  id='td_accName_863'>재평가손실 </td>
							<td class='th3'  id='td_chr_863'>2.일반</td>
							<td class='th4'  id='td_relname_863'></td>
						</tr>
						<input type='hidden' id='Scode_863' value='24'>
						<input type='hidden' name='code_863' value='098300'><tr id='tr_864' onClick="goDetail('098400',864)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_864' id='chk_864' style='height:12px' value='Y' checked></td>
							<td class='th1' >0984</td>
							<td class='th2'  id='td_accName_864'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_864'></td>
							<td class='th4'  id='td_relname_864'></td>
						</tr>
						<input type='hidden' id='Scode_864' value='24'>
						<input type='hidden' name='code_864' value='098400'><tr id='tr_865' onClick="goDetail('098500',865)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_865' id='chk_865' style='height:12px' value='Y' checked></td>
							<td class='th1' >0985</td>
							<td class='th2'  id='td_accName_865'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_865'></td>
							<td class='th4'  id='td_relname_865'></td>
						</tr>
						<input type='hidden' id='Scode_865' value='24'>
						<input type='hidden' name='code_865' value='098500'><tr id='tr_866' onClick="goDetail('098600',866)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_866' id='chk_866' style='height:12px' value='Y' checked></td>
							<td class='th1' >0986</td>
							<td class='th2'  id='td_accName_866'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_866'></td>
							<td class='th4'  id='td_relname_866'></td>
						</tr>
						<input type='hidden' id='Scode_866' value='24'>
						<input type='hidden' name='code_866' value='098600'><tr id='tr_867' onClick="goDetail('098700',867)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_867' id='chk_867' style='height:12px' value='Y' checked></td>
							<td class='th1' >0987</td>
							<td class='th2'  id='td_accName_867'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_867'></td>
							<td class='th4'  id='td_relname_867'></td>
						</tr>
						<input type='hidden' id='Scode_867' value='24'>
						<input type='hidden' name='code_867' value='098700'><tr id='tr_868' onClick="goDetail('098800',868)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_868' id='chk_868' style='height:12px' value='Y' checked></td>
							<td class='th1' >0988</td>
							<td class='th2'  id='td_accName_868'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_868'></td>
							<td class='th4'  id='td_relname_868'></td>
						</tr>
						<input type='hidden' id='Scode_868' value='24'>
						<input type='hidden' name='code_868' value='098800'><tr id='tr_869' onClick="goDetail('098900',869)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_869' id='chk_869' style='height:12px' value='Y' checked></td>
							<td class='th1' >0989</td>
							<td class='th2'  id='td_accName_869'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_869'></td>
							<td class='th4'  id='td_relname_869'></td>
						</tr>
						<input type='hidden' id='Scode_869' value='24'>
						<input type='hidden' name='code_869' value='098900'><tr id='tr_870' onClick="goDetail('099000',870)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_870' id='chk_870' style='height:12px' value='Y' checked></td>
							<td class='th1' >0990</td>
							<td class='th2'  id='td_accName_870'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_870'></td>
							<td class='th4'  id='td_relname_870'></td>
						</tr>
						<input type='hidden' id='Scode_870' value='24'>
						<input type='hidden' name='code_870' value='099000'><tr id='tr_871' onClick="goDetail('099100',871)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_871' id='chk_871' style='height:12px' value='Y' checked></td>
							<td class='th1' >0991</td>
							<td class='th2'  id='td_accName_871'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_871'></td>
							<td class='th4'  id='td_relname_871'></td>
						</tr>
						<input type='hidden' id='Scode_871' value='24'>
						<input type='hidden' name='code_871' value='099100'><tr id='tr_872' onClick="goDetail('099200',872)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_872' id='chk_872' style='height:12px' value='Y' checked></td>
							<td class='th1' >0992</td>
							<td class='th2'  id='td_accName_872'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_872'></td>
							<td class='th4'  id='td_relname_872'></td>
						</tr>
						<input type='hidden' id='Scode_872' value='24'>
						<input type='hidden' name='code_872' value='099200'><tr id='tr_873' onClick="goDetail('099300',873)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_873' id='chk_873' style='height:12px' value='Y' checked></td>
							<td class='th1' >0993</td>
							<td class='th2'  id='td_accName_873'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_873'></td>
							<td class='th4'  id='td_relname_873'></td>
						</tr>
						<input type='hidden' id='Scode_873' value='24'>
						<input type='hidden' name='code_873' value='099300'><tr id='tr_874' onClick="goDetail('099400',874)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_874' id='chk_874' style='height:12px' value='Y' checked></td>
							<td class='th1' >0994</td>
							<td class='th2'  id='td_accName_874'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_874'></td>
							<td class='th4'  id='td_relname_874'></td>
						</tr>
						<input type='hidden' id='Scode_874' value='24'>
						<input type='hidden' name='code_874' value='099400'><tr id='tr_875' onClick="goDetail('099500',875)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_875' id='chk_875' style='height:12px' value='Y' checked></td>
							<td class='th1' >0995</td>
							<td class='th2'  id='td_accName_875'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_875'></td>
							<td class='th4'  id='td_relname_875'></td>
						</tr>
						<input type='hidden' id='Scode_875' value='24'>
						<input type='hidden' name='code_875' value='099500'><tr id='tr_876' onClick="goDetail('099600',876)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_876' id='chk_876' style='height:12px' value='Y' checked></td>
							<td class='th1' >0996</td>
							<td class='th2'  id='td_accName_876'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_876'></td>
							<td class='th4'  id='td_relname_876'></td>
						</tr>
						<input type='hidden' id='Scode_876' value='24'>
						<input type='hidden' name='code_876' value='099600'><tr id='tr_877' onClick="goDetail('099700',877)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_877' id='chk_877' style='height:12px' value='Y' checked></td>
							<td class='th1' >0997</td>
							<td class='th2'  id='td_accName_877'>사용자설정계정과목 </td>
							<td class='th3'  id='td_chr_877'></td>
							<td class='th4'  id='td_relname_877'></td>
						</tr>
						<input type='hidden' id='Scode_877' value='24'>
						<input type='hidden' name='code_877' value='099700'><tr style='background:#e0e0e0'>
								<td class='th5'><input type='checkbox' name='S_25' id='S_25' style='height:12px' value='Y' onClick="chk_Scode('25')" checked></td>
								<td class='th1'></td>
								<td class='th2'><a name='25'>법인(소득)세등</a></td>
								<td class='th3'></td>
								<td class='th4'></td>
							</tr><tr id='tr_878' onClick="goDetail('099800',878)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_878' id='chk_878' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0998</td>
							<td class='th2' style='color:#ec4261' id='td_accName_878'>법인세등 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_878'></td>
							<td class='th4' style='color:#ec4261' id='td_relname_878'></td>
						</tr>
						<input type='hidden' id='Scode_878' value='25'>
						<input type='hidden' name='code_878' value='099800'><tr id='tr_879' onClick="goDetail('099900',879)" style='background:#FFF'>
							<td class='th5'><input type='checkbox' name='chk_879' id='chk_879' style='height:12px' value='Y' checked></td>
							<td class='th1' style='color:#ec4261'>0999</td>
							<td class='th2' style='color:#ec4261' id='td_accName_879'>소득세등 </td>
							<td class='th3' style='color:#ec4261' id='td_chr_879'></td>
							<td class='th4' style='color:#ec4261' id='td_relname_879'></td>
						</tr>
						<input type='hidden' id='Scode_879' value='25'>
						<input type='hidden' name='code_879' value='099900'>		</table>
					</div>
					<div style="padding-top:5px"><input type="button" value="저장" onClick="writesubmit()"></div>
				</div>
				<input type="hidden" name="numrow" id="numrow" value="880">
				</form>

				<div class="right">
					<iframe width="352" height="560" name="summary_detail" src="/index.php?controller=accounting&action=registAccountingCode" frameborder="0"></iframe>
				</div>

				</div>

		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="search_txt" id="search_txt" value="" />
<input type="hidden" name="where" id="where" value="" />
<input type="hidden" name="account_type" id="account_type" value="" />

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

<script>
$(document).ready(function(){
	var page = $("#page").val();
	get_contract(page);
	
	$("#check-all").click(function(){
		if($(this).is(":checked")) $(".chk").attr("checked",true);
		else $(".chk").attr("checked",false);
	});
});

function get_contract(page){
	var tag = "";
	var txt = $("#search_txt").val();
	var page = $("#page").val();
	var search = $("#where").val();
	var account_type = $("#account_type").val();

	//$("#customer_list tbody").remove();

/*
NO
계약일자
만기일자
계약자
피보험자
상품구분
보험사
보험료
*/

	$.getJSON("ajax/contract.php",{"page":page, "mode":"get_contract", "where":search, "account_type":account_type},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>";
					tag += "<input type='checkbox' class='chk flat' name='table_records' value='" + json[i].uid + "'>";
					tag += "</td>";
					tag += "<td><a href='index.php?controller=contract&action=contract_view&uid=" + json[i].uid + "'>" + json[i].join_date + "</a></td>";
					tag += "<td>" + json[i].end_date + "</td>";
					tag += "<td>" + json[i].policyholder + "</td>";
					tag += "<td>" + json[i].insurant + "</td>";
					tag += "<td>" + json[i].ins_div + "</td>";
					tag += "<td>" + json[i].ins_company + "</td>";
					tag += "<td>" + json[i].payment + "</td>";
					tag += "</tr>";
				}
			} 

			$("#contract_list tbody").html(tag);
		
			var table = "contract";
			if(account_type == 0) {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and account_type="  + account_type;
			}
			var rpp = 10;
			var adjacents = 4;
			get_paging(table,where,rpp,adjacents);
		}
	);
}

function set_page(page){
	$("#page").val(page);
	get_contract(page);
}

function get_paging(table,where,rpp,adjacents){
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

function delete_select(){
	if(confirm("선택하신 거래처 정보를 삭제하시겠습니까?")) {
		$(".chk").each(function(){
			if($(this).is(":checked")) {
				var new_uid = $("#chk_uids").val() + "," + $(this).val();
				$("#chk_uids").val(new_uid);
			}
		});

		var dataString = "mode=delete_data&table=contract&uids=" + $("#chk_uids").val();
		$.ajax({
			type : "post",
			url : "ajax/ajax.php",
			data : dataString,
			async : false,
			success : function(str){
				if(str.trim() != "success") alert(str);
				else location.reload();
			}
		});
	} else {
		location.reload();
	}
}

function excel_regist(){
	$("#excel_frm").submit();
}

function search(){
	var txt = $("#search_txt").val();
	$("#where").val(" where 1=1 and (name like '%" + txt + "%' or owner like '%" + txt + "%' or product like '%" + txt + "%')");
	get_contract(1);
}

function set_account(val) {
	$("#page").val(1);
	$("#account_type").val(val);
	get_contract(1);
}
</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/daterangepicker.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="assets/js/jquery.maskedinput.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
			
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

			
			
				
				
				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
			
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					autosize.destroy('textarea[class*=autosize]')
					
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});
			
			});
		</script>
<script type="text/javascript">
function inputSupply(c,n){
	var fid='';	
	if(fid==''){//거래처정보
		openSupplyWrite(c);
	}else{
		if(fid=='clientname'){//전표입력창
			opener.$(fid).value=n;
			var d=fid.split('_');
			if(d[1]){
				opener.$('client_'+d[1]).value=c;
			}else{
				opener.$('client').value=c;
			}
		}else{
			opener.$(fid).value=c;
			opener.$(fid+'name').innerHTML=n;
		}
		
		window.close();
	}
}

function openSupplyWrite(c){
	OpenWindow('supply_reg.html?uid='+c,'MainSupplyReg','510','290','0','410','no');
}

function goSearch(){
	location.href='?fid=&keyword='+$('keyword').value;
}
function goSearch_ent(){
	if(event.keyCode==13){
		goSearch();
	}
}

var currN='';
function goDetail(code,n){
	if(currN!='')ChangeColumnColor($('tr_'+currN),'#FFFFFF');
	ChangeColumnColor($('tr_'+n),'#b7e2e8');
	summary_detail.location.href='account_reg.html?code='+code+'&selno='+n;
	currN=n;
}

var currno='';
function goLoc(code,no){
	//alert($('#Ltr_'+no).text())
	//if(currno!='')ChangeColumnColor($('Ltr_'+currno),'#FFFFFF');
	//ChangeColumnColor($('Ltr_'+no),'#b7e2e8');
	location.href='javascript:void(0);' +code;
	currno=no;
}

//account_code  
function ChangeColor(color,ele){
	document.getElementById(ele).style.backgroundColor=color;
}
function ChangeColumnColor(obj,color){
	//var obj="Ltr_2";
	//alert(obj)
	if(obj){
		obj.style.background=color;
		//$('#Ltr_2').css("background-color","#b7e2e8");
		var num=obj.childNodes.length;	
		for(w=0; w<num; w++){
			var td=obj.childNodes[w].childNodes[0];
			if(td){
				var Fname=td.name;
				if(Fname && td.type!='checkbox')ChangeColor(color,Fname);
			}			
		}

		var tdnum=obj.getElementsByTagName('td').length;
		for(t=0; t<tdnum; t++){
			var td=obj.getElementsByTagName('td')[t];
			if(td)td.style.backgroundColor=color;
		}
	}
}

function setSave(CBno,app,systemcode){
	var params='form/ajx/balance_settle_set.html?mode=acc_save&syy=2017&CBno='+CBno+'&app='+app;
	//alert(params);
	$J.ajax({
		url: params,
		async: true,
		success:function(data){
			/*
			if(data && app=='N'){
				var ment='';
				var no='';
				switch(data){
					case '500' : ment='제조'; no=0; break;
					case '600' : ment='공사'; no=1; break;
					case '650' : ment='분양'; no=2; break;
					case '700' : ment='임대'; no=3; break;
					case '750' : ment='운송'; no=4; break;
				}
				window.alert(data+'번대('+ment+')의 전표가 입력되어 있습니다.\n확인하시기 바랍니다.');
				return;
			}else{
				if(app=='Y'){
					$('use_'+CBno).innerHTML="<font onClick=\"setSave('"+CBno+"','N','"+systemcode+"')\">(사용 여)<font>";
					$('S_'+systemcode).checked=true;
				}else{
					$('use_'+CBno).innerHTML="<font onClick=\"setSave('"+CBno+"','Y','"+systemcode+"')\" style='color:blue'>(사용 부)<font>";
					$('S_'+systemcode).checked=false;
				}
				chk_Scode(systemcode);
			}
			*/

				if(app=='Y'){
					$('use_'+CBno).innerHTML="<font onClick=\"setSave('"+CBno+"','N','"+systemcode+"')\">(사용 여)<font>";
					$('S_'+systemcode).checked=true;
				}else{
					$('use_'+CBno).innerHTML="<font onClick=\"setSave('"+CBno+"','Y','"+systemcode+"')\" style='color:blue'>(사용 부)<font>";
					$('S_'+systemcode).checked=false;
				}
				chk_Scode(systemcode);
		}
	});
}

function chk_all(){
	var Lnum=$('Lnum').value;
	for(var i=1; i<Lnum; i++){
		var systemcode=$('systemcode_'+i).value;
		if($('S_'+systemcode)){
			if($('chkall').checked==false){
				$('S_'+systemcode).checked=false;			
			}else{
				$('S_'+systemcode).checked=true;
			}
		}
	}

	var num=$('numrow').value;
	for(var i=1; i<num; i++){
		if($('chk_'+i)){
			if($('chkall').checked==false){
				$('chk_'+i).checked=false;			
			}else{
				var accName=$('td_accName_'+i).innerHTML;
				if(accName.indexOf('사용자설정계정과목')==-1)$('chk_'+i).checked=true;
			}
		}
	}
}

function chk_Scode(scode){
	var num=$('numrow').value;
	for(var i=1; i<num; i++){
		if($('chk_'+i)){
			var syscode=$('Scode_'+i).value;
			if(syscode==scode){
				if($('S_'+scode).checked==false){
					$('chk_'+i).checked=false;			
				}else{
					var accName=$('td_accName_'+i).innerHTML;
					if(accName.indexOf('사용자설정계정과목')==-1)$('chk_'+i).checked=true;
				}
			}
		}
	}
}

function writesubmit(){
	if(!confirm('사용여부를 저장 하시겠습니까?')){
		return;
	}
	document.acc_hidden.action='?mode=end';
	document.acc_hidden.submit();
}
</script>
<script type="text/javascript">
<!--
	
//-->
</script>