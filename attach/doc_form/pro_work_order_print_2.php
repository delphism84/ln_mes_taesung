

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title></title>
    
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="robots" content="noindex,nofollow">
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />

<link type='text/css' rel='stylesheet'href='/ECMain/ECount.Common/Css2/2_layout.css?v=20160126090841' /><span></span>
    <link type='text/css' rel='stylesheet'href='/ECMain/ECount.Common/Css2/2_print.css?v=20150807092751' /><span></span>

<link type='text/css' rel='stylesheet'href='/ECMain/ECount.Common/Css2/ECCalendar.css?v=20150119181649' /><span></span>
<script language='javascript' src='/ECMain/Scripts/EC_Global.js?v=20131106191134' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/Scripts/key_check.js?v=20110321162824' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/Scripts/dhtmlwindow.js?v=20140410195412' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/ECount.Common/Javascript/decimal.js?v=20150819090810' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/ECount.Common/Javascript/ECount.Common.js?v=20160602153818' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/ECount.Common/Javascript/ECount.Common.Export.js?v=20160706090546' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/ECount.Common/Javascript/jquery-1.3.2.min.js?v=20150410091410' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/ECount.Common/Javascript/jquery.maskedinput-1.2.2.min.js?v=20111124160124' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/Scripts/PrintHid.js?v=20151103090413' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/Scripts/Print.js?v=20121213164736' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/ECount.Common/Javascript/jquery.form.js?v=20120720100832' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/ECount.Common/Javascript/ECount.Common.Math.js?v=20160104090346' type='text/javascript'></script><span></span>

<script language='javascript' src='/ECMain/ECount.Common/Javascript/LoadProgressbar.js?v=20150114181147' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/ECount.Common/Javascript/Util.js?v=20111116102736' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/ECount.Common/Javascript/jquery.hotkeys-0.7.9.js?v=20131113190706' type='text/javascript'></script><span></span>
<script language='javascript' src='/ECMain/ECount.Common/Javascript/ECCalendar_New.js?v=20150410090552' type='text/javascript'></script><span></span>

<script language='javascript' src='/ECMain/ECount.Common/Resource/ko.js?v=20150831092022' type='text/javascript'></script><span></span>

</head>
<body>
    <form method="post" action="./ESJ005R.aspx?ec_req_sid=00J*3lcNlKUs" id="form1">
<div class="aspNetHidden">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKLTUxMDg4OTI3OQ9kFgICMA9kFgJmDxYCHglpbm5lcmh0bWwFWzxvcHRpb24gdmFsdWU9IjEiIC8+7J6R7JeF7KeA7Iuc7IScJm5ic3A7MTxvcHRpb24gdmFsdWU9IjAiIHN0eWxlPSJjb2xvcjojZmYzMzAwOyIgLz7quLDrs7hkZAkYU2mxxetOe6ESd+2a+cCzECgk" />
</div>

<div class="aspNetHidden">

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="4697ADBF" />
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEdAAloViNjJypcQf18W7+HN4ilEw3w8OZT11A7r+F7NwLkDSPs1NIsagmLbpNtTUCle4b5+6bctFF7WYzkURaYy5bAdGqu93+fMkUUhQTcozanz1A/H5aiKHMOyjKxSNjxFZMRoHkaXm4Hu+wgPEe3H2hJVBKFKS52pLFnjARtywsI2Wf+w25Fx4FSo3eJYxTwDsIP8Q+K0p+6b0n1SVuHMh6xJIltbA==" />
</div>
    <div id="wrap_pop">
        <!-- 상단버튼 및 양식설정부분 시작 -->
        <div class="dual-btn-fixed top-zero">
		    <div class="dual-btn-area">
			    <div class="float_left">
                    
                    <span class="btn blue-inverse"><input type="button" name="btnPrint" id="btnPrint" onclick="fnOrderPrint();return false;" value="인쇄" /></span>  
                    <span class="btn gray"><input type="button" name="btn_excel" id="btn_excel" onclick="ExcelPageMovement('/ECMain/ESJ/ESJ005E.aspx');" value="Excel" /></span>            
                    <span class="btn gray"><input type="button" name="btnPdf" id="btnPdf" value="PDF" onclick="fnPdfBeta();" /></span>
                    <span class="btn gray"><input type="button" id="btnPreview" value="최적화" onclick="fnPrintControl();" /></span>            
                    
                </div>
                <!-- 인쇄옵션 시작 -->
                <div class="float_right">
                    <label class="btn_select">
                        <select id="form_ser" name="form_ser" onchange="print_it();">
                            <span id="form_list" name="form_list"><option value="1" />작업지시서&nbsp;1<option value="0" style="color:#ff3300;" />기본</span>
                        </select>
                        </label>
                    <span class="btn gray"><input type="button" name="btnYangsic" id="btnYangsic" onclick="fnYangsic();return false;" value="양식" /></span>
                </div> 
                <!-- 인쇄옵션 끝 -->
            </div>
            <div class="dual-btn-area">
                <div class="float_pop">
                    <label class="btn_txt"><input id="level_gubun" name="level_gubun" type="checkbox" value="Y" onclick="print_it();" />결재방표시 </label>            
                </div>
            </div>
        </div>
        <!-- 상단버튼 및 양식설정부분 끝 -->
        <br /><br /><br /><br /><br /><br /><br />
            <div id="idPrint">
            <div id="rpt_contents" >
            <div style="margin-left:4px; margin-right:4px;">
            <br />
             
                                        
                        <!-- 결재방 -->
                        
                        
                        
                        <table border="0" cellspacing="0" cellpadding="0" style="width:650px; margin-bottom:5px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse">  <tbody>   <tr>    <td style="width:99%; height:30px; font-size:20px; font-weight:bold; line-height:20px; text-align:center"><u>작 업 지 시 서 전 표</u></td>    <td align="right" style="width:1%">     <table cellpadding='0' cellspacing='0' border='0' style='width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed'><tbody><tr><th style='font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word' rowspan='2'>결재</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>결재</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>라인</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>설정</th><th style='font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word'>가능</th></tr><tr><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td><td style='height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word'>&nbsp;</td></tr></tbody></table>    </td>   </tr>  </tbody>  </table>    <div style="width:650px;">   <table border="0" cellspacing="0" cellpadding="0" style="padding:0px; width:650px; font-size:12px; color:#000; line-height:14px; border-collapse:collapse; table-layout:fixed">    <colgroup><col style="width:75px"><col style="width:220px"><col style="width:10px"><col style="width:75px"><col /></colgroup>    <tbody>     <tr>      <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">전표번호</th>      <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;20160806-1</td>      <td>&nbsp;</td>      <th style="padding:3px 0px 2px 0px; text-align:center;background:#f9f9f9; border:1px solid #000; font-weight:bold">납품처</th>      <td style="border-top:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word;">&nbsp;좋은컴퓨터(1234567002)</td>     </tr>          <tr>      <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000; font-weight:bold">담당자</th>      <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;김생산</td>      <td>&nbsp;</td>                  <th style="padding:3px 0px 2px 0px; text-align:center; background:#f9f9f9; border-left:1px solid #000; border-right:1px solid #000; border-bottom:1px solid #000">납기일</th>      <td style="border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word">&nbsp;    .   .   </td>     </tr>    </tbody>   </table>  </div>  
                        
                        <!-- TopSql 끝 -->
                        
                        <!--  리스트 시작 -->
                        <table class="p_rptC" style="width:650px;">
                            
                                <col width="98" />
                            
                                <col width="255" />
                            
                                <col width="151" />
                            
                                <col width="60" />
                            
                                <col width="60" />
                            
                            <thead>
                            <tr>
                            
                                <th  style="height:37px">품목코드</th>
                            
                                <th  style="height:37px">품명 및 규격</th>
                            
                                <th  style="height:37px">생산공장명</th>
                            
                                <th  style="height:37px">수량</th>
                            
                                <th  style="height:37px">안전재고</th>
                                        
                            </tr>                
                            </thead>
                            <tbody>
                                <tr height=23><td class=' left font11px' bgcolor="#FFFFFF" style="   overflow:hidden ">A001</td><td class=' left font11px' bgcolor="#FFFFFF" style="   overflow:hidden ">익스트림 울트라 명품 조립PC</td><td class=' left font11px' bgcolor="#FFFFFF" style="   overflow:hidden "></td><td class=' right font11px' bgcolor="#FFFFFF" style="   overflow:hidden ">90</td><td class=' right font11px' bgcolor="#FFFFFF" style="   overflow:hidden ">0</td></tr>    
                            </tbody>
                        </table>
                        <!--  리스트 끝 -->
                        
                        <!--  BOM(소요량) 리스트 시작 -->
                        
                               <table class="p_rptC" style="width:650px;">
                                    
                                        <col width="59" />
                                    
                                        <col width="93" />
                                    
                                        <col width="60" />
                                    
                                        <col width="65" />
                                    
                                        <col width="125" />
                                    
                                        <col width="217" />
                                    
                                    <thead>
                                    <tr>
                                    
                                        <th  style="height:37px">품목코드</th>
                                    
                                        <th  style="height:37px">품명 및 규격</th>
                                    
                                        <th  style="height:37px">소요량</th>
                                    
                                        <th  style="height:37px">재고수량</th>
                                    
                                        <th  style="height:37px">구매처</th>
                                    
                                        <th  style="height:37px">적요</th>
                                                
                                    </tr>                    
                                    </thead>
                                    <tbody>
                                        <tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">A002</td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">인텔 코어 I7-3770K</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">90</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">507</td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">최고전자</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">A003</td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">G.SKILL DDR3 32G PC5-78500</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">90</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">733</td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">최고전자</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">A004</td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">MSI BIG BANG Z77 MPOWER</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">90</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">606</td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">최고전자</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr><tr height=23><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='right font11px' bgcolor="#FFFFFF" style="  overflow:hidden "></td><td class='left font11px' bgcolor="#FFFFFF" style="  overflow:hidden ">&nbsp;</td><td class='left font11px' bgcolor="#FFFFFF" style=" overflow:hidden ">&nbsp;</td></tr>
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
        
        </div>          
        </div>
        </div>  <!-- div idPrint end -->
        
    </div>
    <div id="div_hidden" name="div_hidden" style="display:none;">
        <input name="hidData" type="text" id="hidData" value="20160806-1-0" />
        <input name="hidReqInfo" type="text" id="hidReqInfo" value="20160806-1-0" />
        <input name="hidAppLevel" type="text" id="hidAppLevel" value="&lt;br>&lt;table align=&#39;center&#39; width=&#39;650&#39; border=&#39;0&#39; cellspacing=&#39;0&#39; cellpadding=&#39;0&#39;>&lt;tr>&lt;td align=&#39;right&#39;>&lt;table cellpadding=&#39;0&#39; cellspacing=&#39;0&#39; border=&#39;0&#39; style=&#39;width:295px; margin:0px 0px 5px 0px; color:#000; border-left:1px solid #000; border-top:1px solid #000; border-collapse:collapse; table-layout:fixed&#39;>&lt;tbody>&lt;tr>&lt;th style=&#39;font-size:12px; width:13px;padding:0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word&#39; rowspan=&#39;2&#39;>결재&lt;/th>&lt;th style=&#39;font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word&#39;>결재&lt;/th>&lt;th style=&#39;font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word&#39;>라인&lt;/th>&lt;th style=&#39;font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word&#39;>설정&lt;/th>&lt;th style=&#39;font-size:12px; width:69px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; background:#ececec; word-wrap:break-word&#39;>가능&lt;/th>&lt;/tr>&lt;tr>&lt;td style=&#39;height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word&#39;>&amp;nbsp;&lt;/td>&lt;td style=&#39;height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word&#39;>&amp;nbsp;&lt;/td>&lt;td style=&#39;height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word&#39;>&amp;nbsp;&lt;/td>&lt;td style=&#39;height:55px; font-size:12px;padding:5px 0px 3px 0px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; word-wrap:break-word&#39;>&amp;nbsp;&lt;/td>&lt;/tr>&lt;/tbody>&lt;/table>&lt;/td>&lt;/tr>&lt;/table>&lt;br>" />
        <input name="hidTopSql" type="text" id="hidTopSql" value="notnull" />
        <input type="hidden" id="pdata" name="pdata" value="20160806-1-0" />
        <input name="hidPageMargin" type="hidden" id="hidPageMargin" value="@page{size:A4;margin-top:13mm;margin-left:4.2mm;margin-right:4.6mm;margin-bottom:5.3mm;}@media print{html,body{min-width:201.2mm;overflow:hidden;}thead {display: table-header-group;}}" />
		<input name="hidPdfMargin" type="hidden" id="hidPdfMargin" value="13∬5.3∬4.2∬4.6" />
		<input name="hidSelPaper" type="hidden" id="hidSelPaper" value="A4" />
		<input name="hidDirection" type="hidden" id="hidDirection" value="P" />
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
        
        document.getElementById('rpt_contents').style.width = "650px";
        
    
        window.onload = function () {
            if($("#form_ser") && $("#form_ser option").length < 1)
                $("#form_ser").attr("disabled", "true");

            //인쇄 용지 설정 적용
            //IE 버전
	        var ieVersion = fnDetectIE();
	        var stylePageMargin = document.createElement('style');        
                if(ieVersion == 8) {
		        stylePageMargin.type = "text/css";
		        stylePageMargin.styleSheet.cssText = document.getElementById("hidPageMargin").value;
	        }else{
		        stylePageMargin.innerHTML = document.getElementById("hidPageMargin").value;
	        }
            document.body.appendChild(stylePageMargin);
        }

        //결재방 인쇄클릭시
        function fnAppLevel() {
            if ($("#level_gubun").get(0).checked) {
                $("#level_gubun").get(0).value = "Y";
                $("#div_appLine").get(0).innerHTML = "";
                $("#div_appLine").get(0).innerHTML = $("#hidAppLevel").get(0).value;
            } else {
                $("#level_gubun").get(0).value = "N";
                var topSql = $("#hidTopSql").get(0).value;
                if (topSql == "") $("#div_appLine").get(0).innerHTML = "<h1 class='rpt_title'>소요량</h1>";
                else $("#div_appLine").get(0).innerHTML = "";
            }
        }

        // ----------------------------------------------------------------------------------
        // 3. 데이터 처리 함수 영역
        // ----------------------------------------------------------------------------------
        // ----------------------------------------------------------------------------------
        // 4. 이벤트 호출 함수 영역
        // ----------------------------------------------------------------------------------
        
        //양식설정
        function fnYangsic() {
            
                var Url = "/ECMain/CM3/CM100P_02.aspx?FORM_GUBUN=SF400&FORM_SER=" + formSer;
            
            fnFormSettingOpen(Url, 'ord_design', 'yes', 800, 700);
            
        }
        
        //엑셀변환
        function ExcelPageMovement(Url) {
            
                $("#frmDetail").get(0).method = "post";
                $("#frmDetail").get(0).action = fnSetUrlPath(Url, "ec_req_sid");
                $("#frmDetail").get(0).target = "ifrmExcel";
                $("#frmDetail").submit();
               
        }

        //양식종류변경시
        function print_it() {
            var frm = $("#form1").get(0);
            frm.method = "post";
            frm.target = "_self";
            frm.action = fnSetUrlPath("ESJ005R.aspx", "ec_req_sid");
            frm.submit();
        }

        var vgubun = "";
        
        if (vgubun != "1"){
        }
        else {
            $(".dual-btn-area").hide();
			LoadProgressbar.show();
            printHidden2_ESprint_order();
        }

        //프린트버튼클릭시
        function fnOrderPrint() {
             var url ="";
             if ($("#level_gubun").get(0).checked) {
                url = "/ECMain/ESJ/ESJ005R.aspx?gubun=1&level_gubun=Y&form_ser=" + $("#form_ser").get(0).value + "&hidData=" + $("#hidData").get(0).value + "&Hits=Y";
             }
             else
             {
                url = "/ECMain/ESJ/ESJ005R.aspx?gubun=1&level_gubun=N&form_ser=" + $("#form_ser").get(0).value + "&hidData=" + $("#hidData").get(0).value + "&Hits=Y";
             }
        
            window.open(fnSetUrlPath(url, "ec_req_sid"), 'orderprint', 'left=50000,top=50000,width=0,height=0');

            if ($("#hidData").get(0).value != "")
            {
                strData = "Type=SALEHISTORY&H_STATUS=O&GB_TYPE=Y&LOOP=S&H_TYPE=12&hidData="+encodeURIComponent($("#hidData").get(0).value);
               fnHistoryInser(strData, "")
            }
        }       
        
        //양식설정된 기본을 세팅해줌
        if(vgubun == "")
        {
            var formSer = $("#formser").get(0).value;
            var f_flag = $("#foreign_flag").get(0).value;
            var bs_type = $("#basic_type").get(0).value;
            $("#form_ser").get(0).value = formSer;
        }

        //PDF 변환
        function fnPdfBeta()
        {     
             var strSelPaper; //용지종류
            var strDirection; //용지 방향	
	
            strSelPaper =  $("#hidSelPaper").val();
            strDirection = $("#hidDirection").val();	
            strPdfMargin = $("#hidPdfMargin").val();

            //용지크기 직접설정일 경우 메시지 띄운후 A4로 셋팅
            if(strSelPaper == "U" || strSelPaper == "B5" ){
	            alert('PDF는 용지크기 직접설정 및 B5를 지원하지 않습니다.');
                strSelPaper = "A4";
            }	
                 
            var Headchk;
            
                Headchk = "3";            
            

            $("#tblPFile").hide();  // pdf 일때 숨김 bsy
            fnExportPdf("ECount", "ESJ005R", "ESJ005R", "ESJ005R", Headchk,  $("#idPrint").html(), strPdfMargin, strSelPaper,strDirection);
            $("#tblPFile").show();  // pdf 일때 숨김 bsy
        }         

        // 첨부된 파일 다운로드 bsy
        function fnFileDownload(value) {
            location.href = fnSetUrlPath("/ECMAIN/EGG/Common/FileDownload.aspx?" + value,'ec_req_sid');
            //location.href = "/ECMAIN/EGG/Common/FileDownload.aspx?" + value;
            return false;
        }

        // 첨부된 파일 id로 보기 bsy
        function fleViewid(linkevalue) {
            var winW1 = "800px";
            var winH1 = "700px";
            var url;             
            var url = "/ECMAIN/EGG/EGG007P_01.aspx?hidSearchData=" + linkevalue;            
            window.open(fnSetUrlPath(url,'ec_req_sid'), "EGG007P_01_POP", "height=" + winH1 + ",width=" + winW1 + ",menubar=no,resizable=no,titlebar=no,scrollbars=1,status=1,toolbar=no,location=no");
        }
        // ----------------------------------------------------------------------------------
        // 5. 기능 처리 함수 영역
        // ----------------------------------------------------------------------------------
        
            function fnHitsUpdate()
        { 
        var hidData = $("#hidData").get(0).value;
             var strData = "FORM_GUBUN=SF400&IO_DATE="+hidData.split('-')[0]+"&IO_NO="+hidData.split('-')[1]+"&CS_FLAG=&IO_TYPE=&Data030_flag=";
                        $.ajax({
                            type: "POST",
                            async: false,
                            url: fnSetUrlPath("/ECMAIN/ESD/ESD006M_DATA.aspx", "ec_req_sid"),
                            data: strData,
                            error: function(errorMsg) {
                                alert("에러발생"+"\nfnGetData:" + errorMsg);
                                //  return false; 
                            },
                            success: function(returnXml) {
                            }
                        });
        }

    </script>
</body>
<style type="text/css"> @page{size:A4;margin-top:13mm;margin-left:4.2mm;margin-right:4.6mm;margin-bottom:5.3mm;}@media print{html,body{min-width:201.2mm;overflow:hidden;}thead {display: table-header-group;}}</style>
</html>
