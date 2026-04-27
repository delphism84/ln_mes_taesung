<?php
include_once("../common.php"); // 기본 파일
include_once("../inc/dbconfig.php"); 
include_once("../inc/func.php");  // 함수 파일
//header("Content-type: text/html; charset=UTF-8"); 
if (!$is_member){
goto_url("/login.php");
exit;
}
?>
<?
//	if ($mode=="modify"){
	$sql = "Select * From item_issue where num = ".$num;
	//echo "sql1=".$sql."<br>"; 
	$result = mysql_query($sql);
	if ($result){
		//$cnt = mysql_num_rows($result);
		$ct=1;
		$row = mysql_fetch_array($result);	
			$num			=$row["num"];
			$issue_no		=$row["issue_no"];
			$basic_date		=$row["basic_date"];
			$ord_no			=$row["ord_no"];
			$ord_cd			=$row["ord_cd"];
			$cust_name		=$row["cust_name"];
			$cust_cd		=$row["cust_cd"];
			$emp_cd			=$row["emp_cd"];
			$emp_name		=$row["emp_name"];
			$outplant_des	=$row["outplant_des"];
			$outplant		=$row["outplant"];
			$inplant_des	=$row["inplant_des"];
			$inplant		=$row["inplant"];
			$regdate		=$row["regdate"];
		}

	$sql = "Select * From item_issueSub where issue_no = '".$issue_no."'";
		//echo $sql."<br>";  
		$result = mysql_query($sql);
		if ($result){
			$no=1;
			while($rows=mysql_fetch_array($result)){
				$idx			=$rows["idx"];									
				$issue_no		=$rows["issue_no"];
				$plan_date		=$rows["plan_date"];
				$plan_no		=$rows["plan_no"];
				$plan_prod		=$rows["plan_prod"];
				$prod_cd		=$rows["prod_cd"];
				$prod_des		=$rows["prod_des"];
				$size_des		=$rows["size_des"];
				$qty			=$rows["qty"];
				$inv_qty		=$rows["inv_qty"];
				$res_qty		=$rows["res_qty"];
				$unit			=$rows["unit"];
				$Process_route	=$rows["Process_route"];
				$remarks		=$rows["remarks"];
				$bom_depth1		=$rows["bom_depth1"];
				$regdate		=$rows["regdate"];
			
				$html_table .="<TR height=20>";
				$html_table .="<TD style=\"OVERFLOW: hidden\" class=\" center font11px\">".$no."</TD>";
				$html_table .="<TD style=\"OVERFLOW: hidden\" class=\" left font11px\">".$prod_cd."</TD>";
				$html_table .="<TD style=\"OVERFLOW: hidden\" class=\" left font11px\">".$prod_des." ".$size_des."</TD>";
				$html_table .="<TD style=\"OVERFLOW: hidden\" class=\" right font11px\">".$qty."</TD>";
				$html_table .="<TD style=\"OVERFLOW: hidden\" class=\" left font11px\">".$remarks."</TD></TR>";
				$qtys[] .= $qty; 
			$no++;	
		}
		//echo $qtys;
			//$tot_qty = array_sum($qtys);
	}
//	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>작업지시서 출력</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />

<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_layout.css?v=20160126090841' /><span></span>
<link type='text/css' rel='stylesheet'href='http://login.ecounterp.com/ECMain/ECount.Common/Css2/2_print.css?v=20150807092751' /><span></span>
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
			<div id="idPrint" class="p-relative" style="margin-top:80px">
				<!--div class="virtualpage hidepiece" printtype="page"-->
					<!--div id="rpt_contents_new"-->
						<!--div class="p-absolute" style="top:0px; left:0px"--> 
<!-- 결재방 -->
<TABLE style="LINE-HEIGHT: 14px; WIDTH: 650px; BORDER-COLLAPSE: collapse; MARGIN-BOTTOM: 5px; COLOR: #000; FONT-SIZE: 12px" border=0 cellSpacing=0 cellPadding=0>
<TBODY>
<TR>
<TD style="TEXT-ALIGN: center; LINE-HEIGHT: 20px; WIDTH: 99%; HEIGHT: 30px; FONT-SIZE: 20px; FONT-WEIGHT: bold"><U>생산불출전표</U></TD>
<TD style="WIDTH: 1%" align=right>
<TABLE style="BORDER-LEFT: #000 1px solid; MARGIN: 0px 0px 5px; WIDTH: 295px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; COLOR: #000; BORDER-TOP: #000 1px solid" border=0 cellSpacing=0 cellPadding=0>
<TBODY>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; WIDTH: 13px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 0px" rowSpan=2>결재</TH>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; WIDTH: 69px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">결재</TH>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; WIDTH: 69px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">라인</TH>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; WIDTH: 69px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">설정</TH>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; WIDTH: 69px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">가능</TH></TR>
<TR>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; HEIGHT: 55px; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">&nbsp;</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; HEIGHT: 55px; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">&nbsp;</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; HEIGHT: 55px; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">&nbsp;</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; HEIGHT: 55px; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">&nbsp;</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>
<TABLE style="PADDING-BOTTOM: 0px; LINE-HEIGHT: 14px; PADDING-LEFT: 0px; WIDTH: 650px; PADDING-RIGHT: 0px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; COLOR: #000; FONT-SIZE: 12px; PADDING-TOP: 0px" border=0 cellSpacing=0 cellPadding=0>
<COLGROUP>
<COL style="WIDTH: 75px">
<COL style="WIDTH: 245px">
<COL style="WIDTH: 10px">
<COL style="WIDTH: 75px">
<COL></COLGROUP>
<TBODY>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-TOP: #000 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">전표번호</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-TOP: #000 1px solid; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$issue_no?> &nbsp;</TD>
<TD>&nbsp;</TD>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-TOP: #000 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">출고처</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-TOP: #000 1px solid; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$outplant_des."(".$outplant.")"?></TD></TR>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">DATE</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$basic_date?></TD>
<TD>&nbsp;</TD>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">입고처</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$inplant_des."(".$inplant.")"?></TD></TR></TBODY></TABLE><!-- TopSql 끝 --><!-- 구매리스트 시작 -->
<TABLE style="WIDTH: 650px; WORD-WRAP: break-word; TABLE-LAYOUT: fixed; WORD-BREAK: break-all" class=p_rptC>
<COLGROUP>
<COL width=44>
<COL width=106>
<COL width=275>
<COL width=54>
<COL width=145>
<THEAD>
<TR>
<TH style="HEIGHT: 22px">순번</TH>
<TH style="HEIGHT: 22px">품목</TH>
<TH style="HEIGHT: 22px">품명 및 규격</TH>
<TH style="HEIGHT: 22px">수량</TH>
<TH style="HEIGHT: 22px">적요</TH></TR></THEAD>
<TBODY>
<?=$html_table?>
<?
if ($no > 10){
$countnum = 17 - $no;
for($i=1; $i < $countnum ;$i++){?>
<TR height=20>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<?}
}?>
</TBODY></TABLE><!-- 구매리스트 끝 -->
<DIV style="MARGIN-TOP: 5px"></DIV>
<TABLE style="BORDER-LEFT: #000 1px solid; LINE-HEIGHT: 14px; MARGIN: 0px; WIDTH: 650px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; HEIGHT: 27px; COLOR: #000; FONT-SIZE: 12px; BORDER-TOP: #000 1px solid" border=0 cellSpacing=0 cellPadding=0>
<COLGROUP>
<COL style="WIDTH: 75px">
<COL style="WIDTH: 300px">
<COL style="WIDTH: 75px">
<COL></COLGROUP>
<TBODY>
<TR>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid">수량</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: right; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid"><?=@array_sum($qtys)?>&nbsp;</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid">인수</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: right; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">인&nbsp;</TD></TR></TBODY></TABLE><!--/DIV--><!-- div class=absolute-->
<!--DIV style="TOP: 135.5mm; LEFT: 0px" class=rpt-line></DIV-->
<!--DIV style="TOP: 145.3mm; LEFT: 0px" class=p-absolute--><!-- 결재방 -->
<!--TABLE style="LINE-HEIGHT: 14px; WIDTH: 650px; BORDER-COLLAPSE: collapse; MARGIN-BOTTOM: 5px; COLOR: #000; FONT-SIZE: 12px" border=0 cellSpacing=0 cellPadding=0>
<TBODY>
<TR>
<TD style="TEXT-ALIGN: center; LINE-HEIGHT: 20px; WIDTH: 99%; HEIGHT: 30px; FONT-SIZE: 20px; FONT-WEIGHT: bold"><U>생산불출전표</U></TD>
<TD style="WIDTH: 1%" align=right>
<TABLE style="BORDER-LEFT: #000 1px solid; MARGIN: 0px 0px 5px; WIDTH: 295px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; COLOR: #000; BORDER-TOP: #000 1px solid" border=0 cellSpacing=0 cellPadding=0>
<TBODY>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 0px; PADDING-LEFT: 0px; WIDTH: 13px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 0px" rowSpan=2>결재</TH>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; WIDTH: 69px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">결재</TH>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; WIDTH: 69px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">라인</TH>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; WIDTH: 69px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">설정</TH>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; WIDTH: 69px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">가능</TH></TR>
<TR>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; HEIGHT: 55px; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">&nbsp;</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; HEIGHT: 55px; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">&nbsp;</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; HEIGHT: 55px; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">&nbsp;</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; PADDING-BOTTOM: 3px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; WORD-WRAP: break-word; HEIGHT: 55px; FONT-SIZE: 12px; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 5px">&nbsp;</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE-->
<!--TABLE style="PADDING-BOTTOM: 0px; LINE-HEIGHT: 14px; PADDING-LEFT: 0px; WIDTH: 650px; PADDING-RIGHT: 0px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; COLOR: #000; FONT-SIZE: 12px; PADDING-TOP: 0px" border=0 cellSpacing=0 cellPadding=0>
<COLGROUP>
<COL style="WIDTH: 75px">
<COL style="WIDTH: 245px">
<COL style="WIDTH: 10px">
<COL style="WIDTH: 75px">
<COL></COLGROUP>
<TBODY>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-TOP: #000 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">전표번호</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-TOP: #000 1px solid; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$issue_no?> &nbsp;</TD>
<TD>&nbsp;</TD>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-TOP: #000 1px solid; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">출고처</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-TOP: #000 1px solid; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$outplant_des."(".$outplant.")"?></TD></TR>
<TR>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">DATE</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$basic_date?></TD>
<TD>&nbsp;</TD>
<TH style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; BORDER-LEFT: #000 1px solid; PADDING-BOTTOM: 2px; PADDING-LEFT: 0px; PADDING-RIGHT: 0px; BACKGROUND: #f9f9f9; BORDER-RIGHT: #000 1px solid; PADDING-TOP: 3px">입고처</TH>
<TD style="BORDER-BOTTOM: #000 1px solid; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">&nbsp;<?=$inplant_des_des."(".$inplant.")"?></TD></TR></TBODY></TABLE--><!-- TopSql 끝 --><!-- 구매리스트 시작 -->
<!--TABLE style="WIDTH: 650px; WORD-WRAP: break-word; TABLE-LAYOUT: fixed; WORD-BREAK: break-all" class=p_rptC>
<COLGROUP>
<COL width=44>
<COL width=106>
<COL width=275>
<COL width=54>
<COL width=145>
<THEAD>
<TR>
<TH style="HEIGHT: 22px">순번</TH>
<TH style="HEIGHT: 22px">품목</TH>
<TH style="HEIGHT: 22px">품명 및 규격</TH>
<TH style="HEIGHT: 22px">수량</TH>
<TH style="HEIGHT: 22px">적요</TH></TR></THEAD>
<TBODY>
<?=$html_table?>
<?
if ($no > 10){
$countnum = 17 - $no;
for($i=1; $i < $countnum ;$i++){?>
<TR height=20>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
<TD>&nbsp;</TD>
</TR>
<?}
}?></TBODY></TABLE--><!-- 구매리스트 끝 -->
<!--DIV style="MARGIN-TOP: 5px"></DIV-->
<!--TABLE style="BORDER-LEFT: #000 1px solid; LINE-HEIGHT: 14px; MARGIN: 0px; WIDTH: 650px; BORDER-COLLAPSE: collapse; TABLE-LAYOUT: fixed; HEIGHT: 27px; COLOR: #000; FONT-SIZE: 12px; BORDER-TOP: #000 1px solid" border=0 cellSpacing=0 cellPadding=0>
<COLGROUP>
<COL style="WIDTH: 75px">
<COL style="WIDTH: 300px">
<COL style="WIDTH: 75px">
<COL></COLGROUP>
<TBODY>
<TR>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid">수량</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: right; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid"><?=@array_sum($qtys)?>&nbsp;</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: center; WORD-WRAP: break-word; BACKGROUND: #ececec; FONT-WEIGHT: bold; BORDER-RIGHT: #000 1px solid">인수</TD>
<TD style="BORDER-BOTTOM: #000 1px solid; TEXT-ALIGN: right; WORD-WRAP: break-word; BORDER-RIGHT: #000 1px solid">인&nbsp;</TD></TR></TBODY></TABLE-->
<!--/DIV--><!-- div class=absolute-->
<!--/DIV--><!-- div id=rpt_contents_new-->
<!--/DIV--><!-- div class=virtualpage hidepiece--><!-- for문 끝 -->
<!--/DIV--><!-- div id=idPrint -->
<!--/CENTER-->
<!-- div idPrint end -->
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






<STYLE type=text/css> @page{size:A4;margin-top:13mm;margin-left:19.3mm;margin-right:4.6mm;margin-bottom:5.3mm;}@media print{html,body{min-width:186.1mm;overflow:hidden;}thead {display: table-header-group;}}</STYLE>

<STYLE type=text/css>@page  {size: A4; margin-top: 13mm; margin-left: 19.3mm; margin-right: 4.6mm; margin-bottom: 5.3mm; }

@media Print    
{
HTML {
	MIN-WIDTH: 186.1mm; OVERFLOW: hidden
}
BODY {
	MIN-WIDTH: 186.1mm; OVERFLOW: hidden
}
THEAD {
	DISPLAY: table-header-group
}

}
</STYLE>
</BODY></HTML>