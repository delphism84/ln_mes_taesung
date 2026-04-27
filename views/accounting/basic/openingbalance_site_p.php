<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>ERMES v1.0</title>

		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<!-- page specific plugin styles -->
		<!-- text fonts -->
		<link rel="stylesheet" href="/assets/css/fonts.googleapis.com.css" />
		<!-- ace styles -->
		<link rel="stylesheet" href="/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="/assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="/assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="/assets/css/common.css" />
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
		<!-- inline styles related to this page -->
		<!-- ace settings handler -->
		<script src="/assets/js/ace-extra.min.js"></script>
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="no-skin">
<form method="post" action="" id="form1">
<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['form1'];
if (!theForm) {
    theForm = document.form1;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}
//]]>
</script>
 <div class="row">
	<div class="col-xs-12">
        <table class="table  table-bordered">
			<tbody>
				<tr>
					<th>빠른 검색을 원한다면 해당항목 설정 후 검색 바랍니다.</th>
				</tr>
				<tr>
					<td class="modal_gray">
						
                        &nbsp;
                        <input name="txtName" type="text" id="txtName" class="default" onfocus="this.select();" />&nbsp;
                        <input type="submit" name="btnSearch" value="검색" onclick="return searchit2();" id="btnSearch" class="btn_searchS" />
                        <input type="submit" name="btnUsestopY" value="사용중단포함" onclick="fn_SortList(&#39;Y&#39;); return false;" id="btnUsestopY" class="btn_searchS" />
                        <input type="submit" name="btnUsestopN" value="사용중단미포함" onclick="fn_SortList(&#39;N&#39;); return false;" id="btnUsestopN" class="btn_searchS" />
					</td>
				</tr>
			</tbody>
		</table>

        <table class="table table-bordered table-hover">
		<thead>
            <tr>
                 
                <th><a href="#" class="th" onclick="fn_SortList('SITE');" width="47%">부서코드<img id="img_num" src="../ECount.Common/Images/icon_arrowBot.gif" width="11" height="15" /></a></th>
                <th><a href="#" class="th" onclick="fn_SortList('SITE_DES')">부서명<img id="img_name" src="../ECount.Common/Images/icon_arrowBot.gif" width="11" height="15" /></a></th>
            </tr>
		</thead>
		<tbody>
		    <tr id="rpt_ctl00_trRpt">
			<td><a href="javascript:fnLink('200|고객지원팀|');" >200</a></td>
			<td><a href="javascript:fnLink('200|고객지원팀|');" >고객지원팀</a></td>
			</tr>
            <tr id="rpt_ctl01_trRpt">
			<td><a href="javascript:fnLink('공통|공통|');" >공통</a></td>
			<td><a href="javascript:fnLink('공통|공통|');" >공통</a></td>
			</tr>
			<tr id="rpt_ctl02_trRpt">
			<td><a href="javascript:fnLink('00001|구매부서|');" >00001</a></td>
			<td><a href="javascript:fnLink('00001|구매부서|');" >구매부서</a></td>
			</tr>
        </tbody>
        </table>
    </div>
    <div class="">
		<span class=""><input type="button" value="닫기" id="btnClose" name="btnClose" /></span>
	</div><!--endof 하단버튼 단-->
	<div id="div_hidField" style="display:none">
		<input name="hid_sort" type="hidden" id="hid_sort" />
		<input name="hid_sortorder" type="hidden" id="hid_sortorder" />
		<input name="hid_usestop" type="hidden" id="hid_usestop" value="N" />
		<input name="hid_chkflag" type="hidden" id="hid_chkflag" value="L" />
		<input name="hid_Mergeflag" type="hidden" id="hid_Mergeflag" value="N" />
		<input name="hidPopUp" type="hidden" id="hidPopUp" />
		<input name="hidInputFlag" type="hidden" id="hidInputFlag" />
		<input name="hidChkValues" type="hidden" id="hidChkValues" />
		<a id="ddd" href="javascript:__doPostBack(&#39;ddd&#39;,&#39;&#39;)"></a>
		<input type="submit" name="btnSearch2" value="" id="btnSearch2" />
	</div>  
</div>
</form>
</body>
</html>
