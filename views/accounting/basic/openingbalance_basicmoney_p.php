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
		<form method="post" action="" id="form1">
			<div id="wrap_pop">        
				<div class="new-title">
					<div class="title-leftarea">기초잔액연월변경</div>                       		
				</div><!--endof 타이틀바-->
				<div class="panel panel-default">
				  <div class="panel-heading">기초잔액연월변경</div>
				</div>
			<div id="contents">
			
				<table class="table">
					<tr>
					<th style="width:110px">설립일자</th>
					<td><strong>1999.01.01</strong></td>
					</tr>
					<tr>
					<th>기초잔액입력월</th>
					<td><strong>2011.12</strong></td>
					</tr>
					
				</table>
				<p style="padding-left:155px; padding-top:6px;"><img src="/ECMain/ECount.common/Images/bt_arrow.gif" /></p>
					<table class="table">
						<tr>
						<th style="width:110px">변경연월<br />(월말)</th>
							<td>
								<span id="ECDateTime">
									<select name="ddlYear" id="ddlYear" onfocus="nextfield =&#39;ddlMonth&#39;;" onchange="fnChange(1);">
										<option value="2017">2017</option>
										<option value="2016">2016</option>
										<option value="2015">2015</option>
										<option value="2014">2014</option>
										<option value="2013">2013</option>
										<option value="2012">2012</option>
										<option selected="selected" value="2011">2011</option>
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
										<option value="1998">1998</option>
									</select>
									<select name="ddlMonth" id="ddlMonth" onfocus="nextfield =&#39;btnUp&#39;;" onchange="fnChange(1);">
										<option value="01">1월</option>
										<option value="02">2월</option>
										<option value="03">3월</option>
										<option value="04">4월</option>
										<option value="05">5월</option>
										<option value="06">6월</option>
										<option value="07">7월</option>
										<option value="08">8월</option>
										<option value="09">9월</option>
										<option value="10">10월</option>
										<option value="11">11월</option>
										<option selected="selected" value="12">12월</option>
									</select>
								</span>
							</td>
						</tr>
					</table>
				<div class="help_box" style="width:336px;">
					<ul><li><strong>기존에 2011년 12월로 입력된 기초잔액은 삭제됩니다.</strong></li></ul>
				</div>
			</div>
			<div class="">
				<span class=" "><input name="btnUp" id="btnUp" type="button" value="변경" onclick="" onfocus="nextfield='btnClose'"/></span>
				<span class=" "><input name="btnClose" id="btnClose" type="button" value="닫기" onclick="window.close();"/></span>
			</div>
			</div>

    </form>
    <form id="frmDetail">
        
        <input type="hidden" id="delflag" name="delflag" value="N" />
        <input type="hidden" id="ini_yy" name="ini_yy" value="  "/>
        <input type="hidden" id="ini_mm" name="ini_mm" value="" />
        <input type="hidden" id="tables" name="tables" value="ACC001" />
    </form>
    <form id="frmDetail2">
        <input type="hidden" id="yymm" name="yymm" value="" />
        <input type="hidden" id="old_site" name="old_site" value="/" />
        <input type="hidden" id="new_site" name="new_site" value="" />
        <input type="hidden" id="sum_type" name ="sum_type" value="" />
        <input type="hidden" id="tables" name="tables" value="ACC102" />
        <input type="hidden" id="delflag" name="delflag" value="N" />
        
    </form>



	</div>
</div>

</body>
</html>
