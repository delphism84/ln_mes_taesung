<?
require_once("library/caseby.php");
$estimate_cd = $this->createCode("estimate_cd","estimate");

$date = date("Y/m/d");
$date2 = date("m");
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>
		<!-- 검색 모달 -->
		<div class="wrap_search_pop">	
			<div class="search_pop_content">
				<div class="input-group">
					<div class="col-xs-12">
						<? $this->periodSearch("searchDate()","날짜검색"); ?>
					</div>
					<!-- <select name="search_classify" id="search_classify" style="height:35px; margin-left:5px">
						<option value="0">== 검색구분 ==</option>
						<option value="item_cd">품번</option>
						<option value="item_nm">품명</option>
						<option value="account_nm">거래처</option>
					</select>-->	
					<div class="col-xs-12">
						<input type="text" name="account_nm" id="account_nm" onclick="showModal('accountModal')" readonly / class="search_input">
						<input type="button" class="search_btn" onclick="search()" value="검색" />
						<button type="button" class="search_refresh" onclick="refresh()">
							<span class="fa fa-refresh icon-on-right bigger-110"></span>
						</button>	
					</div>
				</div>
			</div>
		</div>
		<!-- //검색 모달 -->
		<div class="page-content">
			<div>				
				<div class="col-xs-12">
					<div class="col-xs-12">
						<?							
						echo "<input type='button' class='comm_title' value='판매현황' />";
						echo "</div>";
						$this->noCheckTable("tb","거래처,대표자,거래발생일,잔액");
						$this->paging();
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- 상세보기 -->
<div class="modal fade" id="viewReceivablesModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">상세보기</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style='height:70%'>
			<!-- 내용 -->
				<form id="frm">
					<input type="hidden" name="uid" id="uid"/>
					<table class="table table-bordered">
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; width:25%"><i class="ace-icon fa fa-caret-right blue"></i>거래처</th>
							<td><span id="a_account_nm"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>대표자</th>
							<td><span id="a_owner"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>거래발생일</th>
							<td><span id="a_create_dt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>매출합계</th>
							<td><span id="a_amount"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>수금합계</th>
							<td><span id="a_collect_amount"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>잔액</th>
							<td><span id="a_remain_amount"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>최종수금일</th>
							<td><span id="a_last_collect_dt"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>전화번호</th>
							<td><span id="a_telephone"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>휴대전화</th>
							<td><span id="a_mobile"></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>거래등급</th>
							<td><span id=""></span></td>
						</tr>
						<tr>
							<th class='' style="background-color:#f1f1f1; vertical-align:middle; "><i class="ace-icon fa fa-caret-right blue"></i>수금예정일</th>
							<td><span id="a_next_collect_dt"></span></td>
						</tr>
					</table>

				</form>
			<!-- 내용 -->
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">					
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">창닫기</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- //상세보기 -->
<!-------------------------- 세금계산서 MODAL START----------------------------->
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style type="text/css">
		.bout {
		  font-family:굴림,바탕;
		  border: 3px double blue;
		}

		body, table, tr, td, select{font-family:굴림, verdana, arial; font-size: 12px;color: #000000; border:1px;}
		.ttxt {font-family:굴림, verdana, arial; font-size: 12px;color: #0000FF;}
		.cborder {border-top-width:1; border-right-width:1; border-bottom-width:1; border-left-width:1; border-color:BLUE; border-top-style:solid; border-right-style:none; border-bottom-style:solid; border-left-style:solid;}
		.ctit {font-size: 22px;color: #0000FF; font-weight:bold;}
		.ccmt {font-size: 12px;color: #0000FF;}
		.taxidno {font-size: 16px;color: black; font-weight:bold;}
		.bout2 {font-family:굴림,바탕;border: 3px double red;}
		.ttxt2 {font-family:굴림, verdana, arial; font-size: 12px;color: red;}
		.cborder2 {border-top-width:1; border-right-width:1; border-bottom-width:1; border-left-width:1; border-color:red; border-top-style:solid; border-right-style:none; border-bottom-style:solid; border-left-style:solid;}
		.ctit2 {font-size: 22px;color:red; font-weight:bold;}
		.ccmt2 {font-size: 12px;color:red;}

		#command_bar {
		  font-size: 10pt;
		  background-color: #FEFFD2;
		  border: 1px solid #AF9E29;
		  padding: 5px;
		  margin-bottom: 10px;
		}

		.sign_area {
		  position: relative;
		}

		.sign_img {
		  position: absolute;
		  top: 15px;
		  left: 230px;
		}

	</style>
</head>
<body>
<div class="modal fade" id="taxModal" data-backdrop="static" data-keyboard="false" >
	<div class="modal-dialog" style="width:1000px;">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">세금 계산서</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<br><br>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="height:600px; overflow:auto;">


<!------------- 세금계산서 content start -------------->				
<div id="command_bar">
	A4용지를 준비하고 인쇄버튼을 클릭하세요. &nbsp; <input type="button" value="인쇄하기" onclick="jQuery('#printAreaTax').print()" />
</div>

<DIV ID="printAreaTax"><!--세금계산서 PRINT AREA-->

<!-- 공급자용 세금계산서 -->
<br>
<table width="700" border="1" cellspacing="0" cellpadding="0" align="center">	
  <tr>
    <td height="10">
	<table width="100%" height="10" border="1" cellpadding="0" cellspacing="0">
		<tr> 
		  <td height="10" class="ttxt">[별지 제11호 서식]</td>
		</tr>
	</table>
     </td>
  </tr>
  <tr> 
    <td width="700">
      <table width="100%" border="1" cellpadding="0" cellspacing="0" class="bout">
	<tr> 
	  <td>
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
			<tr>
				<td width="20" height="44"></td>
				<td width="359" align="center"><span class="ctit">세 금 계 산 서</span><span class="ccmt">(공급받는자 보관용)</span></td>
				<td width="201">
					<table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
					    <tr>
					      <td width="25%" class="cborder" align="center" style="border-top-style:none">
						<span class="ttxt">책 번 호</span></td>
					      <td width="33%" align="right" class="cborder" style="border-top-style:none">
						<span class="ttxt">권</span> &nbsp;</td>
					      <td width="42%" align="right" class="cborder" style="border-top-style:none">
						<span class="ttxt">호</span> &nbsp;</td>
					    </tr>
					    <tr>
					      <td class="cborder" align="center" style="border-top-style:none;border-bottom-style:none">
						<span class="ttxt">일련번호</span></td>
					      <td colspan="2" align="center" class="cborder" style="border-top-style:none;border-bottom-style:none"></td>
					    </tr>
					</table>
				</td>
			</tr>
		</table>
	  </td>
	</tr>
	<tr> 
	  <td>
	    <table width="100%" class="cborder" style="border-left-style:none; border-top-style:none;" border="1" cellspacing="0" cellpadding="0">
	     <tr>
	       <td width="50%">
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		     <tr> 
		       <td width="18" align="center" class="cborder" style="border-left-style:none;">
			  <span class="ttxt" style="line-height:35px">공<br>급<br>자</span>
		       </td>
			<td>
			  <div class="sign_area"><!--sign_areac START-->
			  <table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
			    <tr height="35"> 
			      <td width="20%" align="center" class="cborder"><span class="ttxt">등록번호</span></td>
			      <td width="80%" class="cborder" align="center"><span class="business_no" ></span></td>
			    </tr>
			    <tr height="35"> 
			      <td align="center" class="cborder" style="border-top-style:none"><span class="ttxt">상 호<br>(법인명)</span></td>
			      <td>
			       <table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
				  <tr> 
				    <td class="cborder corp_nm" style="border-top-style:none" width="200px;" align="center"></td>
				    <td class="cborder" style="border-top-style:none" align="center" width="25"><span class="ttxt">성<br>명</span></td>
				    <td class="cborder" style="border-top-style:none" align="center" width="100"><span class="owner"></span>&nbsp;
				    <td class="cborder" style="border-top-style:none;" width="30" align="center">
					<span class="sign" style="display:inline-block; transform:scale(0.5)" ></span>
				    </td>
				  </tr>
			       </table>
			      </td>
			    </tr>
			    <tr height="35"> 
			      <td align="center" class="cborder" style="border-top-style:none"><span class="ttxt">사업장<br>주 소</span></td>
			      <td class="cborder" style="border-top-style:none" align="center"><span class="address"></span></td>
			    </tr>
			    <tr height="35"> 
			      <td align="center" class="cborder" style="border-top-style:none"><span class="ttxt">업 태</span></td>
			      <td>
				<table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
				  <tr>
				    <td class="cborder" style="border-top-style:none" align="center"><span class="corp_type"></span>
				    <td class="cborder" style="border-top-style:none" width="30" align="center"><span class="ttxt">종<br>목</span></td>
				    <td class="cborder" style="border-top-style:none" align="center"><span class="corp_event"></span></td>
				  </tr>
				</table>
			      </td>
			    </tr>
			  </table>
			  </div><!--sign_areac END-->
			</td>
		      </tr>
		</table>
	       </td>
	       <td width="50%">
	        <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr> 
	            <td class="cborder" width="18" align="center"><span class="ttxt" style="line-height:20px;">공<br>급<br>받<br> 는<br>자</span></td>
		    <td>
		      <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="35"> 
			  <td width="20%" align="center" class="cborder"><span class="ttxt">등록번호</span></td>
			  <td width="80%" class="cborder" align="center"><span class="corp_reg_no_deal"></span></td>
			</tr>
			<tr height="71"> 
			  <td align="center" class="cborder" style="border-top-style:none"><span class="ttxt">상 호<br>(법인명)</span></td>
			  <td>
			   <table width="100%" height="100%" border="0" cellspacing="0" cellpadding="0">
			    <tr>
			      <td class="cborder" style="border-top-style:none" align="center"><span class="account_nm_deal"></span></td>
			      <td class="cborder" style="border-top-style:none" align="center" width="30"><span class="ttxt">성<br>명</span></td>
			      <td class="cborder" style="border-top-style:none" width="70" align="center"><span class="owner_deal" ></span>&nbsp;</td>
			      <td class="cborder" style="border-top-style:none" align="center" width="100">
					<span ></span>&nbsp;<span class="ttxt">(인)</span>
			      </td>
			    </tr>
			   </table>
			  </td>
			</tr>
			<tr height="35"> 
			    <td align="center" class="cborder" style="border-top-style:none"><span class="ttxt">사업장<br> 주 소</span></td>
			    <td class="cborder" style="border-top-style:none" align="center"><span class="corp_address_deal"></span></td>
			</tr>
			<tr height="35"> 
			    <td align="center" class="cborder" style="border-top-style:none;"><span class="ttxt">업 태</span></td>
			    <td>
				<table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
				  <tr> 
				    <td class="cborder" style="border-top-style:none" align="center"><span class="corp_condition_deal"></span></td>
				    <td class="cborder" style="border-top-style:none" width="30" align="center"><span class="ttxt">종<br> 목</span></td>
				    <td class="cborder" style="border-top-style:none" align="center"><span class="corp_event_deal"></span></td>
				  </tr>
			        </table>
			    </td>
			</tr>
		      </table>
		    </td>
	          </tr>
		</table>
	       </td>
	     </tr>
	    </table>
	  </td>
	</tr>
	<tr> 
	  <td><table width="100%" border="1" cellspacing="0" cellpadding="0" class="cborder" style="border-top-style:none;border-left-style:none">
	      <tr height="20"> 
		<td class="cborder" style="border-top-style:none;border-left-style:none" align="center"><span class="ttxt">작 성</span></td>
		<td class="cborder" style="border-top-style:none" align="center">
			<span class="ttxt">공 &nbsp;&nbsp; 급 &nbsp;&nbsp; 가 &nbsp; &nbsp; 액 </span>
		</td>
		<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">세 &nbsp; &nbsp; 액</span></td>
		<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">비 고</span></td>
	      </tr>
	      <tr> 
		<td><table width="100%" border="1" cellspacing="0" cellpadding="0">
		    <tr height="20"> 
		      <td class="cborder" style="border-top-style:none;border-left-style:none" align="center"><span class="ttxt">년</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">월</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">일</span></td>
		    </tr>
		    <tr height="24"> 
		      <td class="cborder" style="border-top-style:none;border-left-style:none" align="center"><?=substr($date,0,4)?></td>
		      <td class="cborder" style="border-top-style:none" align="center"><?=$date2?></td>
		      <td class="cborder" style="border-top-style:none" align="center"><?=substr($date,8,9)?></td>
		    </tr>
		  </table>
		</td>
		<td><table width="100%" border="1" cellspacing="0" cellpadding="0">
		    <tr height="20"> 
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">공란수</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">백</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">십</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">억</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">천</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">백</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">십</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">만</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">천</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">백</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">십</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">일</span></td>
		  
		    </tr>
		    <tr height="24"> 
		      <td class="cborder" style="border-top-style:none" align="center"><span id="empty_count1"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="cost1_10"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="cost1_9"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="cost1_8"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="cost1_7"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="cost1_6"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="cost1_5"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="cost1_4"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="cost1_3"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="cost1_2"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="cost1_1"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="cost1_0"></span></td>
		    </tr>
		  </table>
		</td>
		<td><table width="100%" border="1" cellspacing="0" cellpadding="0">
		    <tr height="20"> 
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">십</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">억</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">천</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">백</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">십</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">만</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">천</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">백</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">십</span></td>
		      <td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">일</span></td>
		    </tr>
		    <tr height="24"> 
		      <td class="cborder" style="border-top-style:none" align="center"><span id="tax1_9"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="tax1_8"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="tax1_7"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="tax1_6"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="tax1_5"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="tax1_4"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="tax1_3"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="tax1_2"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="tax1_1"></span></td>
                      <td class="cborder" style="border-top-style:none" align="center"><span id="tax1_0"></span></td>
		    </tr>
		  </table>
		</td>
		<td class="cborder" style="border-top-style:none" align="center"><?=$prtInfo['tax_note']?></td>
	      </tr>
	    </table>
	   </td>
	</tr>
	<tr> 
	  <td>
	     <table id="order_item_list1" width="100%" border="1" cellspacing="0" cellpadding="0" class="cborder" style="border-top-style:none;border-left-style:none">
		<thead>
		      <tr height="20"> 
			<td class="cborder" style="border-top-style:none;border-left-style:none" align="center"><span class="ttxt">월</span></td>
			<td class="cborder" style="border-top-style:none;border-left-style:none" align="center"><span class="ttxt">일</span></td>
			<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">품 &nbsp; &nbsp; 목</span></td>
			<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">규 격</span></td>
			<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">수 량</span></td>
			<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">단 가</span></td>
			<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">공 급 가 액</span></td>
			<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">세 액</span></td>
			<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">비 고</span></td>
		      </tr>
		</thead>

		<tbody></tbody>
	
	    </table>
	   </td>
	</tr>
	<tr> 
	  <td><table width="100%" border="1" cellspacing="0" cellpadding="0">
	      <tr height="20"> 
		<td class="cborder" style="border-top-style:none;border-left-style:none" align="center"><span class="ttxt">합 계 금 액</span></td>
		<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">현 금</span></td>
		<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">수 표</span></td>
		<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">어 음</span></td>
		<td class="cborder" style="border-top-style:none" align="center"><span class="ttxt">외상미수금</span></td>
		<td class="cborder" style="border-top-style:none;border-bottom-style:none" rowspan="2" align="center">
		<span class="ttxt">이 금액을</span> <b>영수 / 청구</b> <span class="ttxt">함</span></td>
	      </tr>
	      <tr height="24"> 
		<td class="cborder" style="border-top-style:none;border-left-style:none;border-bottom-style:none" align="center">
			<span class="price_sum"></span></td>
		<td class="cborder" style="border-top-style:none;border-bottom-style:none" align="center">&nbsp;</td>
		<td class="cborder" style="border-top-style:none;border-bottom-style:none" align="center">&nbsp;</td>
		<td class="cborder" style="border-top-style:none;border-bottom-style:none" align="center">&nbsp;</td>
		<td class="cborder" style="border-top-style:none;border-bottom-style:none" align="center">&nbsp;</td>
	      </tr>
	    </table>
	   </td>
	</tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="right">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	  <td class="ccmt">[직인과 일련번호가 있어야 유효합니다]</td>
	</tr>
      </table>
    </td>
  </tr>

<!-- 공급받는자용 절취선 -->
  <tr height="70"> 
    <td><hr size="1" style="border-color:rgb(210, 210, 224)"></td>
  </tr>

<!--공급받는자  세금계산서 시작-->
   <tr>
    <td height="10">
      <table width="100%" height="10" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="10" class="ttxt2">[별지 제11호 서식] &nbsp; [직인과 일련번호가 있어야 유효합니다]</td>
        </tr>
      </table></td>
  </tr>
  
  <tr> 
    <td width="700">
      <table width="100%" cellpadding="1" cellspacing="0" class="bout2">
        <tr> 
          <td>
	    <table width="100%" border="1" cellspacing="0" cellpadding="0">
              <tr>
		<td width="20" height="44"></td>
                <td width="359" align="center"><span class="ctit2">세 금 계 산 서</span><span class="ccmt2">(공급자 보관용)</span></td>
                <td width="201">
		  <table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                      <td width="25%" class="cborder2" align="center" style="border-top-style:none"><span class="ttxt2">책 번 호</span></td>
                      <td width="33%" align="right" class="cborder2" style="border-top-style:none"><?=$prtInfo['bookno']?> <span class="ttxt2">권</span> &nbsp;</td>
                      <td width="42%" align="right" class="cborder2" style="border-top-style:none"><?=$prtInfo['bookno_ho']?> <span class="ttxt2">호</span> &nbsp;</td>
                    </tr>
                    <tr>
                      <td class="cborder2" align="center" style="border-top-style:none;border-bottom-style:none"><span class="ttxt2">일련번호</span></td>
                      <td colspan="2" align="center" class="cborder2" style="border-top-style:none;border-bottom-style:none"><?=$prtInfo['serial']?></td>
                    </tr>
                  </table>
		 </td>
              </tr>
            </table>
	   </td>
        </tr>
        <tr> 
          <td>
	    <table width="100%" class="cborder2" style="border-left-style:none" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%">
		  <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td width="18" align="center" class="cborder2" style="border-left-style:none">
			<span class="ttxt2" style="line-height:35px">공<br>급<br>자</span>
		      </td>
                      <td>
		       <div class="sign_area"><!--SIGN AREA start-->
		        <table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
                          <tr height="35"> 
                            <td width="20%" align="center" class="cborder2"><span class="ttxt2">등록번호</span></td>
                            <td width="80%" class="cborder2" align="center"><span class="business_no"></span></td>
                          </tr>
                          <tr height="35"> 
                            <td align="center" class="cborder2" style="border-top-style:none"><span class="ttxt2">상 호<br>(법인명)</span> 
			    </td>
                            <td>
			     <table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td class="cborder2" style="border-top-style:none" align="center" width="200px;"><span class="corp_nm"></span></td>
                                  <td class="cborder2" style="border-top-style:none" align="center" width="30"><span class="ttxt2">성<br>명</span></td>
                                  <td class="cborder2" style="border-top-style:none" align="center" width="100">
					<span Class="owner"></span>&nbsp;
				  </td>
				  <td class="cborder2" style="border-top-style:none;" width="30" align="center">
					<span class="sign" style="display:inline-block; transform:scale(0.5)" ></span>
				  </td>
                                </tr>
                             </table>
			    </td>
                          </tr>
                          <tr height="35"> 
                            <td align="center" class="cborder2" style="border-top-style:none"><span class="ttxt2">사업장<br>주 소</span></td>
                            <td class="cborder2" style="border-top-style:none" align="center"><span class="address"></td>
                          </tr>
                          <tr height="35"> 
                            <td align="center" class="cborder2" style="border-top-style:none"><span class="ttxt2">업 태</span></td>
                            <td>
			       <table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td class="cborder2" style="border-top-style:none" align="center"><span class="corp_type"></span></td>
                                  <td class="cborder2" style="border-top-style:none" width="30" align="center"><span class="ttxt2">종<br>목</span></td>
                                  <td class="cborder2" style="border-top-style:none" align="center"><span class="corp_event"></td>
                                </tr>
                              </table>
			    </td>
                          </tr>
                        </table>
		       </div><!--SIGN AREA END-->
		      </td>
                    </tr>
                  </table>
		 </td>
                <td width="50%"><table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td class="cborder2" width="18" align="center">
			<span class="ttxt2" style="line-height:20px">공<br> 급<br> 받<br>는<br> 자</span>
		      </td>

                      <td><table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
                          <tr height="35"> 
                            <td width="20%" align="center" class="cborder2"><span class="ttxt2">등록번호</span></td>
                            <td width="80%" class="cborder2" align="center"><span class="corp_reg_no_deal"></span></td>
                          </tr>
                          <tr height="71"> 
                            <td align="center" class="cborder2" style="border-top-style:none"><span class="ttxt2">상 호<br>(법인명)</span></td>
                              <td>
			       <table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td class="cborder2" style="border-top-style:none" align="center"><span class="account_nm_deal"></span></td>
                                  <td class="cborder2" style="border-top-style:none" align="center" width="30"><span class="ttxt2">성<br>명</span></td>
                                  <td class="cborder2" style="border-top-style:none" width="60" align="center"><span class="owner_deal"></span>&nbsp;</td>
				  <td class="cborder2" style="border-top-style:none" align="center" width="100">
					<span></span>&nbsp;<span class="ttxt2">(인)</span>
				  </td>	
                                </tr>
                               </table>
			     </td>
                          </tr>
                          <tr height="35"> 
                            <td align="center" class="cborder2" style="border-top-style:none"><span class="ttxt2">사업장<br> 주 소</span></td>
                            <td class="cborder2" style="border-top-style:none" align="center"><span class="corp_address_deal"></span></td>
                          </tr>
                          <tr height="35"> 
                            <td align="center" class="cborder2" style="border-top-style:none"><span class="ttxt2">업 태</span></td>
                            <td>
			       <table width="100%" height="100%" border="1" cellspacing="0" cellpadding="0">
                                <tr> 
                                  <td class="cborder2" style="border-top-style:none" align="center"><span class="corp_condition_deal"></span></td>
                                  <td class="cborder2" style="border-top-style:none" width="30" align="center"><span class="ttxt2">종<br> 목</span></td>
                                  <td class="cborder2" style="border-top-style:none" align="center"><span class="corp_event_deal"></span></td>
                                </tr>
                              </table>
			     </td>
                          </tr>
                        </table>
		      </td>
                    </tr>
                  </table>
		 </td>
              </tr>
            </table>
	   </td>
        </tr>
        <tr> 
          <td>
	    <table width="100%" border="1" cellspacing="0" cellpadding="0" class="cborder2" style="border-top-style:none;border-left-style:none">
              <tr height="20"> 
                <td class="cborder2" style="border-top-style:none;border-left-style:none" align="center"><span class="ttxt2">작 성</span></td>
                <td class="cborder2" style="border-top-style:none" align="center">
			<span class="ttxt2">공 &nbsp; &nbsp; 급 &nbsp; &nbsp; 가 &nbsp; &nbsp; 액</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">세 &nbsp; &nbsp; 액</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">비 고</span></td>
              </tr>
              <tr> 
                <td>
		  <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr height="20"> 
                      <td class="cborder2" style="border-top-style:none;border-left-style:none" align="center"><span class="ttxt2">년</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">월</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">일</span></td>
                    </tr>
                    <tr height="24">
		       <td class="cborder2" style="border-top-style:none;border-left-style:none" align="center"><?=substr($date,0,4)?></td>
		      <td class="cborder2" style="border-top-style:none" align="center"><?=$date2?></td>
		      <td class="cborder2" style="border-top-style:none" align="center"><?=substr($date,8,9)?></td>
                    </tr>
                  </table>
		</td>
                <td>
		  <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr height="20"> 
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">공란수</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">백</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">십</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">억</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">천</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">백</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">십</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">만</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">천</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">백</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">십</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">일</span></td>
		      <td class="cborder2" style="border-top-style:none" align="center">&nbsp</td>
                    </tr>
                    <tr height="24"> 
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="empty_count2"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="cost2_10"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="cost2_9"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="cost2_8"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="cost2_7"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="cost2_6"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="cost2_5"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="cost2_4"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="cost2_3"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="cost2_2"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="cost2_1"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="cost2_0"></span></td>
		      <td class="cborder2" style="border-top-style:none" align="center">&nbsp</td>
                    </tr>
                  </table>
		 </td>
                <td>
		  <table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr height="20"> 
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">십</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">억</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">천</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">백</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">십</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">만</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">천</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">백</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">십</span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">일</span></td>
                    </tr>
                    <tr height="24"> 
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="tax2_9"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="tax2_8"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="tax2_7"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="tax2_6"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="tax2_5"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="tax2_4"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="tax2_3"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="tax2_2"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="tax2_1"></span></td>
                      <td class="cborder2" style="border-top-style:none" align="center"><span id="tax2_0"></span></td>
                    </tr>
                  </table>
		</td>
                <td class="cborder2" style="border-top-style:none" align="center"><?=$prtInfo['tax_note']?></td>
              </tr>
            </table>
	   </td>
        </tr>
        <tr> 
          <td>
	   <table id="order_item_list2" width="100%" border="1" cellspacing="0" cellpadding="0" class="cborder2" style="border-top-style:none;border-left-style:none">
	     <thead>
              <tr height="20"> 
                <td class="cborder2" style="border-top-style:none;border-left-style:none" align="center"><span class="ttxt2">월</span></td>
                <td class="cborder2" style="border-top-style:none;border-left-style:none" align="center"><span class="ttxt2">일</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">품 &nbsp; &nbsp; 목</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">규 격</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">수 량</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">단 가</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">공 급 가 액</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">세 액</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">비 고</span></td>
              </tr>
	     </thead>
	     
	     <tbody></tbody>

            </table>
	   </td>
        </tr>
        <tr> 
          <td>
	    <table width="100%" border="1" cellspacing="0" cellpadding="0">
              <tr height="20"> 
                <td class="cborder2" style="border-top-style:none;border-left-style:none" align="center"><span class="ttxt2">합 계 금 액</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">현 금</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">수 표</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">어 음</span></td>
                <td class="cborder2" style="border-top-style:none" align="center"><span class="ttxt2">외상미수금</span></td>
                <td class="cborder2" style="border-top-style:none;border-bottom-style:none" rowspan="2" align="center">
		<span class="ttxt2">이 금액을</span><b> 영수 / 청구 </b> <span class="ttxt2">함</span></td>
              </tr>
              <tr height="24"> 
                <td class="cborder2" style="border-top-style:none;border-left-style:none;border-bottom-style:none" align="center">
		<span class="price_sum"></span></td>
                <td class="cborder2" style="border-top-style:none;border-bottom-style:none" align="center">&nbsp;</td>
                <td class="cborder2" style="border-top-style:none;border-bottom-style:none" align="center">&nbsp;</td>
                <td class="cborder2" style="border-top-style:none;border-bottom-style:none" align="center">&nbsp;</td>
                <td class="cborder2" style="border-top-style:none;border-bottom-style:none" align="center">&nbsp;</td>
              </tr>
            </table>
	  </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="right">
      <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
          <td class="ccmt2">[직인과 일련번호가 있어야 유효합니다]</td>
        </tr>
     </table>
</table>
<Br><Br>

</DIV ><!--세금계산서 PRINT AREA-->
<!------- 세금계산서 CONTENT END ---------->	

			</div>
		</div>
		<!-- Modal footer -->
		<div class="modal-footer">
			<div style="text-align:center">
				<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>
</body>



<!-------------------------- 세금계산서 MODAL END----------------------------->

<!-------------------------- 거래명세서 MODAL START----------------------------->

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style type="text/css">
		.bout {
		  font-family:굴림,바탕;
		  border: 3px double blue;
		}

		body, table, tr, td, select{font-family:굴림, verdana, arial; font-size: 12px;color: #000000; border:1px;}
		.ttxt {font-family:굴림, verdana, arial; font-size: 12px;color: #0000FF;}
		.cborder {border-top-width:1; border-right-width:1; border-bottom-width:1; border-left-width:1; border-color:BLUE; border-top-style:solid; border-right-style:none; border-bottom-style:solid; border-left-style:solid;}
		.ctit {font-size: 22px;color: #0000FF; font-weight:bold;}
		.ccmt {font-size: 12px;color: #0000FF;}
		.taxidno {font-size: 16px;color: black; font-weight:bold;}
		.bout2 {font-family:굴림,바탕;border: 3px double red;}
		.ttxt2 {font-family:굴림, verdana, arial; font-size: 12px;color: red;}
		.cborder2 {border-top-width:1; border-right-width:1; border-bottom-width:1; border-left-width:1; border-color:red; border-top-style:solid; border-right-style:none; border-bottom-style:solid; border-left-style:solid;}
		.ctit2 {font-size: 22px;color:red; font-weight:bold;}
		.ccmt2 {font-size: 12px;color:red;}

		#command_bar {
		  font-size: 10pt;
		  background-color: #FEFFD2;
		  border: 1px solid #AF9E29;
		  padding: 5px;
		  margin-bottom: 10px;
		}

		.sign_area {
		  position: relative;
		}

		.sign_img {
		  position: absolute;
		  top: 15px;
		  left: 230px;
		}

	</style>
</head>
<body>
	<div class="modal fade" id="payableModal" data-backdrop="static" data-keyboard="false" >
		<div class="modal-dialog" style="width:1000px;">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header" style="background:#007bff">
					<span style="font-weight:bold; color:#fff; font-size:14pt">거래 명세서</span>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<br><br>
				</div>

				<!-- Modal body -->
				<div class="modal-body" style="height:600px; overflow:auto;">

<!--------  거래명세서 MODAL COMTENT START ----------->
<div id="command_bar">
	A4용지를 준비하고 인쇄버튼을 클릭하세요. &nbsp; <input type="button" value="인쇄하기" onclick="jQuery('#printAreaDeal').print()" />
</div><br><br>

<DIV ID="printAreaDeal"><!--거래명세서 PRINT AREA-->

<table id="payable1" width="95%" border="1" cellspacing="0" cellpadding="0" style='border-collapse:collapse;border:none;' align='center'>
	<thead>
	<tr>
		<td rowspan="2" colspan="9" valign="middle" style='width:280px;height:53px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;line-height:120%;'>
			<span style='font-size:18.0pt;font-family:"새굴림";font-weight:bold;color:#0059ff;line-height:120%'>거래명세표</span></p>

			<p class=Hstyle0 style='text-align:center;line-height:120%;'>
			<span style='font-size:9.0pt;font-family:"새굴림";color:#0059ff;line-height:120%'>(공급 받는 자 보관용)</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:26px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:10pt;font-family:"돋음";color:#0059ff;line-height:160% weight:200px;'>거래일자</span></p>
		</td>
		<td colspan="7" valign="middle" style='width:116px;height:26px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:9.0pt;font-family:"돋음";color:#0059ff;line-height:160%;' class="create_dt"></span></p>
		</td>
		<td colspan="2" valign="middle" style='width:30px;height:26px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>No</span></p>
		</td>
		<td colspan="6" valign="middle" style='width:163px;height:26px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:9.0pt;font-family:"돋음";line-height:160%'>&nbsp;</span></p>
		</td>
	</tr>
	<tr>
		<td colspan="3" valign="middle" style='width:93px;height:26px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:9pt;font-family:"돋음";color:#0059ff;line-height:160%'>공급자 연락처</span></p>
		</td>
		<td colspan="14" valign="middle" style='width:304px;height:26px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-family:"돋음";color:#0059ff;font-weight:bold' class="telephone"></span></p>
		</td>
	</tr>
	<tr>
		<td colspan="2" valign="middle" style='width:97px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:9.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>공급자</span></p>
		</td>
		<td colspan="10" valign="middle" style='width:239px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:10pt;font-family:"돋음";color:#0059ff;line-height:160%' class="business_no"></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:95px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:9.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>공급 받는 자</span></p>
		</td>
		<td colspan="12" valign="middle" style='width:246px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:10pt;font-family:"돋음";color:#0059ff;line-height:160%' class="corp_reg_no_deal"></span></p>
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>상호</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:153px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:10pt;font-family:"돋음";color:#0059ff;line-height:160%' class="corp_nm"></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:37px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>성명</span></p>
		</td>
		<td colspan="2" valign="middle" style='width:65px;height:23px;border-left:solid #0059ff 0.4pt;border-right:none;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";line-height:160%' class="owner"></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:36px;height:23px;border-left:none;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'><span class="sign" style="display:inline-block; transform:scale(0.6)" ></span></p>
		</td>
		<td valign="middle" style='width:37px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>상호</span></p>
		</td>
		<td colspan="6" valign="middle" style='width:165px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:10pt;font-family:"돋음";color:#0059ff;line-height:160%' class="account_nm_deal"></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:37px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt' >
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>성명</span></p>
		</td>
		<td colspan="2" valign="middle" style='width:65px;height:23px;border-left:solid #0059ff 0.4pt;border-right:none;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:8.0pt;font-family:"돋음";line-height:160%' CLASS="owner_deal"></span></p>
		</td>
		<td colspan="1" valign="middle" style='width:36px;height:23px;border-left:none;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'><span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>(인)</span></p>
			
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>주소</span></p>
		</td>
		<td colspan="11" valign="middle" style='width:291px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%' class="address"></span></p>
		</td>
		<td valign="middle" style='width:37px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>주소</span></p>
		</td>
		<td colspan="14" valign="middle" style='width:304px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%' class="corp_address_deal"></span></p>
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>업태</span></p>
		</td>
		<td colspan="2" valign="middle" style='width:123px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%' class="corp_type"></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:37px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>종목</span></p>
		</td>
		<td colspan="6" valign="middle" style='width:131px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%' class="corp_event"></span></p>
		</td>
		<td colspan="1" valign="middle" style='width:37px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>비고</span></p>
		</td>
		<td colspan="6" valign="middle" style='width:165px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";line-height:160%'>&nbsp;</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:50px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>인수자</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:88px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";line-height:160%'>&nbsp;</span></p>
		</td>
	</tr>
	<tr>
		<td colspan="1" valign="middle" style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>월일</span></p>
		</td>
		<td colspan="5" valign="middle" style='width:171px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>품명 / 규격</span></p>
		</td>
		<td colspan="2" valign="middle" style='width:56px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>단위</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>수량</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:79px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>단가</span></p>
		</td>
		<td colspan="5" valign="middle" style='width:103px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>공급가액</span></p>
		</td>
		<td colspan="5" valign="middle" style='width:86px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>세액</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:81px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>비고</span></p>
		</td>
	</tr>
	</thead>

	<!--공급받는자-->
	<tbody></tbody>
	

	<tfoot>
	<tr>
		<td valign="middle" style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="5" valign="middle" style='width:172px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>==이하 여백==</span></p>
		</td>
		<td colspan="2" valign="middle" style='width:56px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:79px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="5" valign="middle" style='width:103px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="5" valign="middle" style='width:86px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:81px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="5" valign="middle" style='width:172px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'></span></p>
		</td>
		<td colspan="2" valign="middle" style='width:56px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:79px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="5" valign="middle" style='width:103px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="5" valign="middle" style='width:86px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:81px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'><span style='font-size:8.0pt;font-family:"돋음";line-height:160%'></span></p>
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:25px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:9.0pt;font-family:"돋음";font-weight:bold;color:#0059ff;line-height:160%'>합계</span></p>
		</td>
		<td colspan="16" valign="middle" style='width:434px;height:25px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:13pt;font-family:"돋음";color:#0059ff;line-height:160%' class="price_sum"></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:25px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>전 잔금</span></p>
		</td>
		<td colspan="7" valign="middle" style='width:142px;height:25px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:9.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>\</span></p>
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:25px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:9.0pt;font-family:"돋음";font-weight:bold;color:#0059ff;line-height:160%'>메모</span></p>
		</td>
		<td colspan="16" valign="middle" style='width:434px;height:25px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'><span style='font-size:9.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>&nbsp;</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:25px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>총 잔금</span></p>
		</td>
		<td colspan="7" valign="middle" style='width:142px;height:25px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 0.4pt;border-bottom:solid #0059ff 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'><span style='font-size:9.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>\</span></p>
		</td>
	</tr>
	</tfoot>
</table>

<p class=Hstyle0></P>
<p class=Hstyle0><span style='font-size:9.0pt;font-family:"돋음";color:#0059ff;line-height:160%'>&nbsp;&nbsp;&nbsp;&lt;공급받는자 보관용&gt;</span></p>
<p class=Hstyle0><BR></P>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<!-- 절취선
<tr height="70"> 
	<td><hr size="1" style="border-color:rgb(210, 210, 224)"></td>
</tr>
 -->
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<p class=Hstyle0><BR></P>
<p class=Hstyle0><span style='font-size:9.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>&nbsp;&nbsp;&nbsp;&lt;공급자 보관용&gt;</span></p>
<p class=Hstyle0></P>

<table id="payable2"  width="95%" border="1" cellspacing="0" cellpadding="0" style='border-collapse:collapse;border:none;' align='center'>
	<thead>
	<tr>
		<td rowspan="2" colspan="9" valign="middle" style='width:280px;height:53px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;line-height:120%;'>
			<span style='font-size:18.0pt;font-family:"돋음";font-weight:bold;color:#ff0052;line-height:120%'>거래명세표</span></p>

			<p class=Hstyle0 style='text-align:center;line-height:120%;'>
			<span style='font-size:9.0pt;font-family:"돋음";color:#ff0052;line-height:120%'>(공급 받는 자 보관용)</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:26px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:10pt;font-family:"돋음";color:#ff0052;line-height:160% weight:200px;'>일자</span></p>
		</td>
		<td colspan="7" valign="middle" style='width:116px;height:26px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:9.0pt;font-family:"돋음";color:#ff0052;line-height:160%;' class="create_dt"></span></p>
		</td>
		<td colspan="2" valign="middle" style='width:30px;height:26px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>No</span></p>
		</td>
		<td colspan="6" valign="middle" style='width:163px;height:26px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:9.0pt;font-family:"돋음";line-height:160%'>&nbsp;</span></p>
		</td>
	</tr>
	<tr>
		<td colspan="3" valign="middle" style='width:93px;height:26px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>공급자 연락처</span></p>
		</td>
		<td colspan="14" valign="middle" style='width:304px;height:26px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 0.4pt;color:#ff0052border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-family:"돋음";color:#ff0052;font-weight:bold' class="telephone"></span></p>
		</td>
	</tr>
	<tr>
		<td colspan="2" valign="middle" style='width:97px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:9.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>공급자</span></p>
		</td>
		<td colspan="10" valign="middle" style='width:239px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:10pt;font-family:"돋음";color:#ff0052;line-height:160%' class="business_no"></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:95px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:9.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>공급 받는 자</span></p>
		</td>
		<td colspan="12" valign="middle" style='width:246px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:10pt;font-family:"돋음";color:#ff0052;line-height:160%' class="corp_reg_no_deal"></span></p>
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>상호</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:153px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%' class="corp_nm"></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:37px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>성명</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:65px;height:23px;border-left:solid #ff0052 0.4pt;border-right:none;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";line-height:160%' CLASS="owner"></span></p>
		</td>
		<td colspan="2" valign="middle" style='width:36px;height:23px;border-left:none;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'><span class="sign" style="display:inline-block; transform:scale(0.6)" ></span></p>
		</td>
		<td valign="middle" style='width:37px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>상호</span></p>
		</td>
		<td colspan="6" valign="middle" style='width:165px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:10pt;font-family:"돋음";color:#ff0052;line-height:160%' class="account_nm_deal" ></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:37px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>성명</span></p>
		</td>
		<td colspan="2" valign="middle" style='width:65px;height:23px;border-left:solid #ff0052 0.4pt;border-right:none;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";line-height:160%' class="owner_deal" ></span></p>
		</td>
		<td colspan="1" valign="middle" style='width:36px;height:23px;border-left:none;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>(인)</span></p>
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>주소</span></p>
		</td>
		<td colspan="11" valign="middle" style='width:291px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%' class="address"></span></p>
		</td>
		<td valign="middle" style='width:37px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>주소</span></p>
		</td>
		<td colspan="14" valign="middle" style='width:304px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%' class="corp_address_deal"></span></p>
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>업태</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:123px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%' class="corp_type"></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:37px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>종목</span></p>
		</td>
		<td colspan="5" valign="middle" style='width:131px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%' class="corp_event"></span></p>
		</td>
		<td colspan="1" valign="middle" style='width:37px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>비고</span></p>
		</td>
		<td colspan="6" valign="middle" style='width:165px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>&nbsp;</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:50px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>인수자</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:88px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>&nbsp;</span></p>
		</td>
	</tr>
	<tr>
		<td colspan="1" valign="middle" style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>월일</span></p>
		</td>
		<td colspan="5" valign="middle" style='width:171px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>품명 / 규격</span></p>
		</td>
		<td colspan="2" valign="middle" style='width:56px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>단위</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>수량</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:79px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>단가</span></p>
		</td>
		<td colspan="5" valign="middle" style='width:103px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>공급가액</span></p>
		</td>
		<td colspan="5" valign="middle" style='width:86px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>세액</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:81px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>비고</span></p>
		</td>
	</tr>
	</thead>

	<!--공급받는자-->
	<tbody></tbody>
	
	<tfoot>
	<tr>
		<td valign="middle" style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
		<td colspan="5" valign="middle" style='width:172px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>==이하 여백==</span></p>
		</td>
		<td colspan="2" valign="middle" style='width:56px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:79px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>&nbsp;</span></p>
		</td>
		<td colspan="5" valign="middle" style='width:103px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
		<td colspan="5" valign="middle" style='width:86px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:81px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
		<td colspan="5" valign="middle" style='width:172px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
		<td colspan="2" valign="middle" style='width:56px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:79px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>&nbsp;</span></p>
		</td>
		<td colspan="5" valign="middle" style='width:103px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
		<td colspan="5" valign="middle" style='width:86px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:81px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:right;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'></span></p>
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:25px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:9.0pt;font-family:"돋음";font-weight:bold;color:#ff0052;line-height:160%'>합계</span></p>
		</td>
		<td colspan="16" valign="middle" style='width:434px;height:25px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:13pt;font-family:"돋음";color:#ff0052;line-height:160%' class="price_sum"></span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:25px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>전 잔금</span></p>
		</td>
		<td colspan="7" valign="middle" style='width:142px;height:25px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:9.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>\</span></p>
		</td>
	</tr>
	<tr>
		<td valign="middle" style='width:45px;height:25px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:9.0pt;font-family:"돋음";font-weight:bold;color:#ff0052;line-height:160%'>메모</span></p>
		</td>
		<td colspan="16" valign="middle" style='width:434px;height:25px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:9.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>&nbsp;</span></p>
		</td>
		<td colspan="3" valign="middle" style='width:56px;height:25px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:center;'>
			<span style='font-size:8.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>총 잔금</span></p>
		</td>
		<td colspan="7" valign="middle" style='width:142px;height:25px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 0.4pt;border-bottom:solid #ff0052 1.1pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'>
			<p class=Hstyle0 style='text-align:left;'>
			<span style='font-size:9.0pt;font-family:"돋음";color:#ff0052;line-height:160%'>\</span></p>
		</td>
	</tr>
	</tfoot>
</table>
<br><br><br>	

</DIV ><!--거래명세서 PRINT AREA-->

<!--------  거래명세서 MODAL COMTENT END ----------->
				</div>
			</div>
			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">닫기</button>
				</div>
			</div>
		</div>
	</div>
</body>

<!---------------- 거래명세서 MODAL END------------------->

<input type="hidden" name="per" id="per" value="10" />

<?
$this->hidden("where state='y'");
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
require_once ("views/modal/accountModal.php");
//require_once ("views/modal/payableModal.php");
//require_once ("views/modal/taxModal.php");

?>

<script>
function refresh(){
	$("#where").val("");
	$("#page").val(1);
	$("#account_nm").val("");
	$("#account_cd").val("");
	getData(1);
}

$(document).ready(function(){
	var page = $("#page").val();	
	getAccountList()		//거래처명Modal getJSON
	getData(1);
});

//콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

//콤마풀기
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

function inputNumberFormat(obj) {
    obj.value = comma(uncomma(obj.value));
}

//==================================================
// 선택 거래처 처리
//==================================================
function postAccount(account_cd, account_nm) {
	$("#account_cd").val(account_cd);
	$("#account_nm").val(account_nm);
	hideModal("accountModal");
}

//==================================================
// 견적서 테이블 선택된 TR 색상 바꾸기
//==================================================
function toggle(it) {
	$("#tb tr").css("background-color","");
	if ((it.style.backgroundColor == "none") || (it.style.backgroundColor == "")) {
		it.style.backgroundColor = "#dce775";
	} else {
		it.style.backgroundColor = "";
	}
}

//==================================================
// 업체별 세부 판매현황
//==================================================
function getData(page){
	var tag = "";	
	var parameter = {"mode" : "getReceivablesList", "rpp" : $("#per").val(), "adjacents" : 4, "page" : page, "where" : $("#where").val()};
	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr onclick='toggle(this); receivablesData(" + json[i].uid + ");' style='cursor:pointer'>";

					tag += "<td style='vertical-align:middle'>" + json[i].account_nm + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].owner + "</td>";
					tag += "<td style='vertical-align:middle'>" + json[i].create_dt + "</td>";							
					//tag += "<td style='vertical-align:middle; text-align:right'>" + comma(json[i].amount) + "</td>";
					//tag += "<td style='vertical-align:middle; text-align:right'>" + comma(json[i].collect_amount) + "</td>";
					tag += "<td style='vertical-align:middle; text-align:right'>" + comma(json[i].remain_amount) + "</td>";
					//tag += "<td style='vertical-align:middle; text-align:right'>" + json[i].last_collect_dt + "</td>";
					//tag += "<td style='vertical-align:middle; text-align:right'>" + json[i].telephone + "</td>";
					//tag += "<td style='vertical-align:middle; text-align:right'>" + json[i].mobile + "</td>";
					//tag += "<td></td>";
					//tag += "<td>" + json[i].next_collect_dt + "</td>";
					
					//tag += "<td style='vertical-align:middle'><input type='button' class='btn btn-xs btn-primary' value='세금계산서' onclick=\"postData(" + json[i].uid + ",'" + json[i].account_cd + "','" + json[i].account_nm + "', '" + json[i].amount + "','" + json[i].create_dt + "' , '" + json[i].owner + "' , '" + json[i].provide_amount + "' , '" + json[i].remain_amount + "' , '" + json[i].telephone + "' , 'taxModal' )\" /> ";
					
					//tag+="<input type='button' class='btn btn-xs btn-success' value='거래명세서' onclick=\"postData(" + json[i].uid + ",'" + json[i].account_cd + "','" + json[i].account_nm + "', '" + json[i].amount + "','" + json[i].create_dt + "' , '" + json[i].owner + "' , '" + json[i].provide_amount + "' , '" + json[i].remain_amount + "' , '" + json[i].telephone + "' , 'payableModal' )\" /></td>";

					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='12' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);

			var table = "receivables";
			getPaging(table, $("#where").val(), $("#per").val(), 4, "setPage");
		}
	);
}

//상세보기
function receivablesData(uid) {
	$("#uid").val(uid);
	var parameter = {"mode" : "getReceivables", "uid":uid}
	$.getJSON("ajax.php", {"parameter":parameter}, function(json){
		if(json != null){
			$("#a_account_nm").html(json.account_nm);
			$("#a_owner").html(json.owner);
			$("#a_create_dt").html(json.create_dt);
			$("#a_amount").html(comma(json.amount));
			$("#a_collect_amount").html(comma(json.collect_amount));
			$("#a_remain_amount").html(comma(json.remain_amount));
			$("#a_last_collect_dt").html(json.last_collect_dt);
			$("#a_telephone").html(json.telephone);
			$("#a_mobile").html(json.mobile);
			//거래등급자리
			$("#a_next_collect_dt").html(json.next_collect_dt);
		}
	});
	showModal('viewReceivablesModal');
}
//==================================================
// 세금계산서 ㅣ 거래명세서
//==================================================
function postData(uid , account_cd , account_nm , amount , create_dt , owner , provide_amount , remain_amount , telephone , Modal ){
	
	$(".create_dt").text(create_dt);
	
	//거래명세서에 공급자 정보 넣어주기
	//세금계산서에 공급자 정보 넣어주기
	var parameter = {"mode": "getAccountInfo" , "account_cd" : account_cd ,"account_nm" : account_nm }	
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			
			$(".corp_phone_deal").text( json[0].corp_phone );		//공급자 연락처
			$(".corp_reg_no_deal").text( json[0].corp_reg_no );		//공급자사업자번호
			$(".account_nm_deal").text( json[0].account_nm );		//거래처명
			$(".owner_deal").text( json[0].owner );				//대표자명
			$(".corp_address_deal").text( json[0].corp_address );		//회사주소
			$(".corp_condition_deal").text( json[0].corp_condition );	//업태
			$(".corp_event_deal").text( json[0].corp_event );		//종목
		}
	});

	//회사기본정보.
	var parameter2 = { "mode" : "getCompanyInfo"};
	$.getJSON("ajax.php" , {"parameter" : parameter2 } , function(json){
	
		if(json != null){
			$(".corp_nm").text( json[0].corp_nm );		//상호
			$(".business_no").text( json[0].business_no );	//사업자등록번호
			$(".owner").text( json[0].owner );		//대표
			$(".telephone").text( json[0].telephone );	
			$(".fax").text( json[0].fax );			
			$(".zipcode").text( json[0].zipcode );		//우편번호
			$(".address").text( json[0].address );		//주소
			$(".corp_type").text( json[0].corp_type );	//업태
			$(".corp_event").text( json[0].corp_event );	//종목

			var image = "<img src='attach/"+json[0].sign+"' style='width:70px; height:70px;'/>";
			$(".sign").html( image );			//도장

			$(".admin").text( json[0].admin );		//관리자아이디
		}
	});

	//미수금 품목내역 불러오기.
	var tag1 ="";
	var tag2 ="";
	var tag3 ="";
	var tag4 ="";

	var parameter = {"mode": "getReceivablesItemList" , "fid" : uid }
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json){
		if(json != null){
			
			var totalprice = 0;
			var supply_priceSum = 0;
			var taxSum = 0;

			for(var i=0 ; i<json.length ; i++){

				var price = Math.round(Number(json[i].cnt)*Number(json[i].reversion_sales_price));	//수량 * 조정금액
				var supply_price = Math.round(price/1.1);
				var tax = price - supply_price;

				supply_priceSum =  supply_priceSum + supply_price;
				taxSum = taxSum + tax;
				totalprice = Number(totalprice) + Number(supply_price) + Number(tax);	//합계금액

				//거래명세서 공급받는자 보관용 품목리스트(BLUE)
				tag1+="<tr>";
				tag1+="<td class='cborder' colspan='1' valign='middle style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#0059ff;line-height:160%'>"+create_dt.substr(5,9)+"</span></p></td>";
				tag1+="<td class='cborder' colspan='5' valign='middle style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#0059ff;line-height:160%'>"+json[i].item_nm+" / "+json[i].standard+"</span></p></td>";
				tag1+="<td class='cborder' colspan='2' valign='middle style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#0059ff;line-height:160%'>"+json[i].unit+"</span></p></td>";
				tag1+="<td class='cborder' colspan='3' valign='middle style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#0059ff;line-height:160%'>"+comma(json[i].cnt)+"</span></p></td>";
				tag1+="<td class='cborder' colspan='3' valign='middle style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#0059ff;line-height:160%'>"+comma(json[i].reversion_sales_price)+"</span></p></td>";
				tag1+="<td class='cborder' colspan='5' valign='middle style='width:45px;height:23px;border-left:solid #0059ff 1.1pt;border-right:solid #0059ff 0.4pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#0059ff;line-height:160%'>"+comma(supply_price)+"</span></p></td>";
				tag1+="<td class='cborder' colspan='5' valign='middle' style='width:81px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt;color:#0059ff;line-height:160%'>"+comma(tax)+"</span></p></td>";
				tag1+="<td class='cborder' colspan='1' valign='middle' style='width:81px;height:23px;border-left:solid #0059ff 0.4pt;border-right:solid #0059ff 1.1pt;border-top:solid #0059ff 1.1pt;border-bottom:solid #0059ff 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:8.0pt;color:#0059ff;line-height:160%'></span></p></td>";
				tag1+="</tr>";

				//거래명세서 공급자 보관용 품목리스트(RED)
				tag2+="<tr>";
				tag2+="<td class='cborder2' colspan='1' valign='middle style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#ff0052;line-height:160%'>"+create_dt.substr(5,9)+"</span></p></td>";
				tag2+="<td class='cborder2' colspan='5' valign='middle style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#ff0052;line-height:160%'>"+json[i].item_nm+" / "+json[i].standard+"</span></p></td>";
				tag2+="<td class='cborder2' colspan='2' valign='middle style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#ff0052;line-height:160%'>"+json[i].unit+"</span></p></td>";
				tag2+="<td class='cborder2' colspan='3' valign='middle style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#ff0052;line-height:160%'>"+comma(json[i].cnt)+"</span></p></td>";
				tag2+="<td class='cborder2' colspan='3' valign='middle style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#ff0052;line-height:160%'>"+comma(json[i].reversion_sales_price)+"</span></p></td>";
				tag2+="<td class='cborder2' colspan='5' valign='middle style='width:45px;height:23px;border-left:solid #ff0052 1.1pt;border-right:solid #ff0052 0.4pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt; color:#ff0052;line-height:160%'>"+comma(supply_price)+"</span></p></td>";
				tag2+="<td class='cborder2' colspan='5' valign='middle' style='width:81px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:10pt;color:#ff0052;line-height:160%'>"+comma(tax)+"</span></p></td>";
				tag2+="<td class='cborder2' colspan='1' valign='middle' style='width:81px;height:23px;border-left:solid #ff0052 0.4pt;border-right:solid #ff0052 1.1pt;border-top:solid #ff0052 1.1pt;border-bottom:solid #ff0052 0.4pt;padding:1.4pt 5.1pt 1.4pt 5.1pt'><p class=Hstyle0 style='text-align:center;'><span style='font-size:8.0pt;color:#ff0052;line-height:160%'></span></p></td>";
				tag2+="</tr>";
						
				//세금계산서 공급받는자 보관용 품목리스트(BLUE)
				tag3+="<tr height='24'>";
				tag3+="<td class='cborder' style='border-top-style:none;border-left-style:none' align='center'>"+<?=$date2?>+"</td>";
				tag3+="<td class='cborder' style='border-top-style:none' align='center'>"+<?=substr($date,8,9)?>+"</td>";
				tag3+="<td class='cborder' style='border-top-style:none' align='center'>"+json[i].item_nm+"</td>";
				tag3+="<td class='cborder' style='border-top-style:none' align='center'>"+json[i].standard+"</td>";
				tag3+="<td class='cborder' style='border-top-style:none' align='center'>"+comma(json[i].cnt)+"</td>";
				tag3+="<td class='cborder' style='border-top-style:none' align='center'>"+comma(json[i].reversion_sales_price)+"</td>";
				tag3+="<td class='cborder' style='border-top-style:none' align='center'>"+comma(json[i].supply_price)+"</td>";
				tag3+="<td class='cborder' style='border-top-style:none' align='center'>"+comma(json[i].tax)+"</td>";
				tag3+="<td class='cborder' style='border-top-style:none' align='center'></td>";
				tag3+="</tr>";
				//세금계산서 공급자 보관용 품목리스트(RED)
				tag4+="<tr height='24'>";
				tag4+="<td class='cborder2' style='border-top-style:none;border-left-style:none' align='center'>"+<?=$date2?>+"</td>";
				tag4+="<td class='cborder2' style='border-top-style:none' align='center'>"+<?=substr($date,8,9)?>+"</td>";
				tag4+="<td class='cborder2' style='border-top-style:none' align='center'>"+json[i].item_nm+"</td>";
				tag4+="<td class='cborder2' style='border-top-style:none' align='center'>"+json[i].standard+"</td>";
				tag4+="<td class='cborder2' style='border-top-style:none' align='center'>"+comma(json[i].cnt)+"</td>";
				tag4+="<td class='cborder2' style='border-top-style:none' align='center'>"+comma(json[i].reversion_sales_price)+"</td>";
				tag4+="<td class='cborder2' style='border-top-style:none' align='center'>"+comma(json[i].supply_price)+"</td>";
				tag4+="<td class='cborder2' style='border-top-style:none' align='center'>"+comma(json[i].tax)+"</td>";
				tag4+="<td class='cborder2' style='border-top-style:none' align='center'></td>";
				tag4+="</tr>";
			}
		}
		
		$("#payable1 tbody").html( tag1 );			//거래명세서 공급받는자 보관용(파란색)
		$("#payable2 tbody").html( tag2 );			//서래명세서 공급자 보관용(빨간색)
		$("#order_item_list1 tbody").html( tag3 );		//세금계산서 공급받는자 보관용(파란색)
		$("#order_item_list2 tbody").html( tag4 );		//세금계산서 공급자 보관용(빨간색)
		$(".price_sum").text(comma(totalprice));
		calculation( supply_priceSum , taxSum );		//공급가액, 세액 합계 
	});

	
	showModal(Modal);
}


//==================================================
//공급가액합 세액 합계 다루기
//==================================================
function calculation(supply_priceSum , taxSum ){

	var supply_priceString = supply_priceSum.toString();
	var taxString = taxSum.toString();

	var supply_priceLength =  Number( supply_priceString.length );
	var taxLength =  Number( taxString.length );

	//========================
	// total공급가액 한칸씩 자르기
	//========================
	var price_unit = 0;						//공급가액(잔여지불금) 세금계산서에 한칸씩 넣어주기
	for(var i=supply_priceLength-1 ; i>=0 ; i--){			
		var supply_split = supply_priceString.substr(i,1);
		$("#cost1_"+ price_unit ).html( supply_split );		//금액한칸(공급받는자 보관용)
		$("#cost2_"+ price_unit ).html( supply_split );		//금액한칸(공급자 보관용)	
		price_unit++;
	}
	
	var empty_count = 0;						//공란계산
	for(var i=supply_priceLength ; i<11 ; i++){			//사용하지 않은 금액칸 빈칸만들기.		
		$("#cost1_"+ i ).html( "" );			
		$("#cost2_"+ i ).html( "" );
		empty_count++;
	}
	$("#empty_count1").text(empty_count);	//공란수
	$("#empty_count2").text(empty_count);

	//========================
	// total세액 한칸씩 자르기
	//========================
	var tax_unit = 0;						//세액 세금계산서에 한칸씩 넣어주기
	for(var i=taxLength-1 ; i>=0 ; i--){			
		var tax_split = taxString.substr(i,1);
		$("#tax1_"+ tax_unit ).html( tax_split );		//금액한칸(공급받는자 보관용)
		$("#tax2_"+ tax_unit ).html( tax_split );		//금액한칸(공급자 보관용)	
		tax_unit++;
	}

	for(var i=taxLength ; i<11 ; i++){				//사용하지 않은 세금칸 빈칸만들기.		
		$("#tax1_"+ i ).html( "" );			
		$("#tax2_"+ i ).html( "" );
	}
}

//콤마찍기
function comma(str) {
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, '$1,');
}

//콤마풀기
function uncomma(str) {
    str = String(str);
    return str.replace(/[^\d]+/g, '');
}

//==================================================
// 검색
//==================================================
function search(){
	var type = 1;

	if(type == 1){
		var search_txt = $("#account_nm").val();
		if(search_txt == "") {
			showAlert("검색어를 입력하세요");
			return false;
		}

		$("#where").val("where account_nm like '%" + search_txt + "%' ");
	}

	$("#page").val(1);
	getData(1);
}

//==================================================
// 날짜별로 데이터 가져오기
//==================================================
function searchDate() {
	var first = $("#start_dt").val();
	var second = $("#end_dt").val();
	if(parseInt(first.replace(/-/g,""),10) > parseInt(second.replace(/-/g,""),10)){
		showAlert("검색 시작일이 검색 종료일 보다 미래일 수 없습니다");
		return;
	}

	var txt = "where (date(create_dt) between '" + first + "' and '" + second + "')";
	$("#where").val(txt);

	getData(1);
}
//검색
$(function(){
	$('.search_pop').click(function(){
		$('.wrap_search_pop').slideToggle(1)
	})
})
</script>