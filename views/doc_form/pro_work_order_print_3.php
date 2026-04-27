<?
session_start();

require_once('../../connection.php');
require_once('../../library/json.php');
require_once('../../library/function.php');

extract($_POST);
extract($_GET);
?>
<?
//	if ($mode=="modify"){
	$sql = "Select * From erp_work where uid = ".$uid;
	//echo $sql."<br>"; 
	$t = @mysql_fetch_object(mysql_query($sql));
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>작업지시서 출력</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />


<script type="text/javascript" src="/weberp/js/jquery.js"></script>
<script type="text/javascript">
<!--
			var initBody;
		function beforePrint()
		{ 
		   initBody = document.body.innerHTML; 
		   document.body.innerHTML = print_page.innerHTML;
		} 

		function afterPrint()
		{ 
		  document.body.innerHTML = initBody; 
		} 

		function pageprint()
		{
			 window.onbeforeprint = beforePrint; 
			 window.onafterprint = afterPrint; 
			 window.print(); 
		}

		//엑셀변환
        function ExcelPageMovement(Url) {
            
                $("#frmDetail").get(0).method = "post";
                $("#frmDetail").get(0).action = fnSetUrlPath(Url, "ec_req_sid");
                $("#frmDetail").get(0).target = "ifrmExcel";
                $("#frmDetail").submit();
               
        }

//-->
</script>
</head>
<body>
	<form method="post" action="./ESJ005R.aspx?ec_req_sid=00J*3lcNlKUs" id="form1">
    <input type="hidden" id="hidHeightParam" name="hidHeightParam"  /> <!--종이 인쇄시 호환성일경우 Page Break시 hidHeightParam 지정된 높이를 사용함 -->      
	<div id="wrap_pop">
        <!-- 상단버튼 및 양식설정부분 시작 --> 
        <div class="dual-btn-fixed top-zero">
		    <div class="dual-btn-area">
			    <div class="float_left">
                   <span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="this.parentElement.style.display = 'none'; pageprint(); this.parentElement.style.display = ''; "  value="인쇄" /></span>
						<!--span class="btn gray"><input type="button" name="btn_excel" id="btn_excel" onclick="ExcelPageMovement('/ECMain/ESD/ESD002E.php');" value="Excel" /></span-->           
						<!--span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span-->
                </div>
            </div><!-- 인쇄옵션 끝 -->
        </div>
        <!-- 인쇄옵션 끝 -->
        <center>
        <div id='print_page'>
			<link type='text/css' rel='stylesheet'href='/assets/css/2_layout.css?v=20190126090841' /><span></span>
			<link type='text/css' rel='stylesheet'href='/assets/css/2_print.css?v=20190807092751' /><span></span>
			<div id="idPrint" class="p-relative" style="margin-top:80px">
				<!--div class="virtualpage hidepiece" printtype="page"!-->
					<!--div id="rpt_contents_new"-->
						<!--div class="p-absolute" style="top:0px; left:0px"--> 
							<!-- 결재방 -->
							<table border="0" cellspacing="0" cellpadding="0" style="width:650px; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">  <tbody>   <tr>    <td style="width:99%; height:30px; font-size:20px; font-weight:bold; line-height:20px; text-align:center"><u>작 업 지 시 서</u></td>    <td align="right" style="width:1%">     <table cellpadding='0' cellspacing='0' border='0' style='width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed'><tbody><tr><th style='font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word' rowspan='2'>결재</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>작성</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>검토</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>승인</th></tr><tr><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td></tr></tbody></table>    </td>   </tr>  </tbody>  </table>    <div style="width:650px;">   <table border="0" cellspacing="0" cellpadding="0" style="padding:0px; width:650px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse; table-layout:fixed">    <colgroup><col style="width:75px"><col style="width:220px"><col style="width:10px"><col style="width:75px"><col /></colgroup>    <tbody>     <tr>      <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">작업지시번호</th>      <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$t->work_cd?></td>      <td>&nbsp;</td>      <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">납품처</th>      <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;<?=$t->account_nm?></td>     </tr>          <tr>      <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">담당자</th>      <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$t->emp_id?></td>      <td>&nbsp;</td>                  <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000">생산작업일</th><td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;<?=$t->start_dt?></td>     </tr>    </tbody>   </table>  </div>  
							
							<!-- TopSql 끝 -->
							
							<!--  리스트 시작 -->
							<table class="p_rptC" style="width:650px;">
									<col width="100" />
									<col width="130" />
									<col width="130" />
									<col width="150" />
									<col width="60" />
									<col width="60" />
								<thead>
								<tr>
									<th  style="height:37px" nowrap>품목코드</th>
									<th  style="height:37px" nowrap>품명 및 규격</th>
									<th  style="height:37px" nowrap>생산공장</th>
									<th  style="height:37px" nowrap>생산설비</th>
									<th  style="height:37px" nowrap>생산수량</th>
									<th  style="height:37px" nowrap>비고</th>
								</tr>                
								</thead>
								<tbody>
								<?
									$sql = "Select * From erp_work_item where wid = '".$t->uid."'";
									//echo $sql."<br>";  
									$result = mysql_query($sql);
									$cnt = mysql_num_rows($result);
									if ($result){
										if ($cnt>"0"){
											$ct=1;
											while($t1 = mysql_fetch_object($result)) {
										
							?>	
									<tr height=23><td class=' left font11px' bgcolor="#FFFFFF" style="   overflow:hidden "><?=$t1->item_cd?></td><td class=' left font11px' bgcolor="#FFFFFF" style="   overflow:hidden "><?=$t1->item_nm?></td><td class=' left font11px' bgcolor="#FFFFFF" style="   overflow:hidden "><?=$t1->warehouse_nm?></td><td class=' left font11px' bgcolor="#FFFFFF" style="   overflow:hidden "><?=$t1->machine_nm?></td><td class=' right font11px' bgcolor="#FFFFFF" style="   overflow:hidden "><?=$t1->order_cnt?></td><td class=' right font11px' bgcolor="#FFFFFF" style="   overflow:hidden "></td></tr>
								<? }
								  }
								  }
								  ?>
								</tbody>
							</table>
							<!--  리스트 끝 -->
							
							<!--  BOM(소요량) 리스트 시작 -->
							<table class="p_rptC" style="width:650px;">
								<col width="100" />
								<col width="175" />
								<col width="60" />
								<col width="65" />
								<col width="125" />
								<col width="100" />
								<thead>
								<tr>
									<th  style="height:37px" nowrap>품목코드</th>								
									<th  style="height:37px" nowrap>품명 및 규격</th>								
									<th  style="height:37px" nowrap>소요량</th>								
									<th  style="height:37px" nowrap>재고수량</th>								
									<th  style="height:37px" nowrap>구매처</th>								
									<th  style="height:37px" nowrap>적요</th>											
								</tr>                    
								</thead>
								<tbody>
									
									<?
									$sql = "Select * From erp_work_item where wid = '".$t->uid."'";
									//echo $sql."<br>";  
									$result = mysql_query($sql);
									$cnt = mysql_num_rows($result);
									if ($result){
										if ($cnt>"0"){
											$ct=1;
											while($t2 = mysql_fetch_object($result)) {
												$sql = "select * from erp_item where item_cd='". $t2->item_cd ."' and standard1='".$t2->standard1."' ";
												//echo $sql."<br>";  
												$res1 = mysql_fetch_object(mysql_query($sql));
									
														$sql = "select * from erp_bom where fid=".$res1->uid;
														//echo $sql."<br>";  
														$results = mysql_query($sql);
														$cnts = mysql_num_rows($results);
														if ($results){
															if ($cnts>"0"){
																$cts=1;
																while($t3 = mysql_fetch_object($results)) {

																	$sql = "select * from erp_item where item_cd='". $t3->item_cd ."' and standard1='".$t3->standard1."' ";
																	//echo $sql."<br>";  
																	$res2 = mysql_fetch_object(mysql_query($sql));

																	$sql = "select sum(remain_cnt)as remain_cnt from erp_stock_inout where item_cd='". $t3->item_cd ."' and standard1='".$t3->standard1."' and used='n' and remain_cnt >0 group by item_cd, standard1";
																	//echo $sql."<br>";  
																	$st = mysql_fetch_object(mysql_query($sql));

															?>
									<tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "><?=$t3->item_cd?></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "><?=$t3->item_nm?></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "><?=$t3->cnt?></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "><?=$st->remain_cnt?></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "><?=$res2->account_nm?></td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr>
															<?
															}
														}
													  }
											?>
									<?	}
										}
										}
									?>
									<tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr>
								</tbody>
							</table>
							<!--  소요 리스트 끝 -->
							<table width="300px" border="0" cellspacing="0" cellpadding="0"><tr><td  style="height:5px;"></td></tr></table>    
							<br><br>
							 <!-- for문 끝 -->
							<table summary="" class="listgray"  align="center"  style="width:650px" id="tblPFile">
							<col width="130" /><col width="" />
							  <!-- for (int u = 0; u < dtLinkData.Rows.Count;u++) end -->
							</table>
							  <!-- if (iloop_cnt == 1) end -->
							<!-- for문 끝 -->
						<!--/div-->
					<!--/div-->
					 
				<!--/div--><!-- div idPrint end -->
			</div> 
		</div>
		</center>
	</div>	
	</form>
    
    <form id="frmDetail">
        <input name="hidSearchXml" type="hidden" id="hidSearchXml" value="20160806-1-0" />
        <input type="hidden" name="formser" id="formser" value="1" />
        <input type="hidden" name="basicFormser" id="basicFormser" value="0" />
        <input name="level" type="hidden" id="level" value="&lt;%=strLevelGubun %>" />
        <input name="cust" type="hidden" id="cust" />
        <input name="cust_des" type="hidden" id="cust_des" />
        <input name="amount" type="hidden" id="amount" />
        <input name="amount_des" type="hidden" id="amount_des" />
        <input type="hidden" name="foreign_flag" id="foreign_flag" value="0" />
        <input type="hidden" name="basic_type" id="basic_type" value="" />
        <input type="hidden" name="edms_flag" id="edms_flag" value="N" />
    </form>
    <iframe name="ifrmExcel" style="width:0px; height:0px"></iframe>
    <script language="javascript" type="text/javascript">
        // ----------------------------------------------------------------------------------
        // 1. 전역변수 선언 영역
        // ----------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------
        // 2. 초기 실행 함수 영역
        // ----------------------------------------------------------------------------------
        
        document.getElementById('rpt_contents_new').style.width = "650px";
    </script>
</body>
<style type="text/css"> @page{size:A4;margin-top:13mm;margin-left:4.2mm;margin-right:4.6mm;margin-bottom:5.3mm;}@media print{html,body{min-width:201.2mm;overflow:hidden;}thead {display: table-header-group;}}</style>
</html>
