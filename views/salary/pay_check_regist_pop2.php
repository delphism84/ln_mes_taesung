<?require_once("assets/head_pop.php");?>
<?

session_start();
extract($_POST);
extract($_GET);
?>
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
					급여정보입력
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						급여정보입력.
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="salary" />
						<input type="hidden" name="action" id="action" value="registPayCheckInsert" />
						<input type="hidden" name="purchase_deposit_ca" id="purchase_deposit_ca" value="" />
						<input type="hidden" name="totalprice" id="totalprice" value="" />
						
						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
								        <col id="col1" /><col id="col2" /><col id="col3" /><col width="" />
        <tr>
            <th id="th1">귀속연월-차수</th>
            <td>
                <span id="lblPDate1"><span id="ECDateTimeServer1"><select name="ECDateTimeServer1$ddlPYear" id="ddlPYear">
	<option selected="selected" value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>

</select><select name="ECDateTimeServer1$ddlPMonth" id="ddlPMonth">
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
	<option selected="selected" value="11">11월</option>
	<option value="12">12월</option>

</select><input name="ECDateTimeServer1$txtDay_ECDateTimeServer1" type="text" maxlength="2" size="2" id="txtDay_ECDateTimeServer1" style="width:20px;display:none;" /></span>
                
                (급여차수<select name="ddlPayGroup" id="ddlPayGroup">
	<option value="0">1</option>

</select>)
                </span>
                <span id="lblPDate2"></span>
                <span id="lblModifyFlag" style="display:none;">(<input name="cbModifyFlag" type="checkbox" id="cbModifyFlag" value="N" />확정)</span>
            </td>
            <td class="info"><div>지급대상 월을 선택합니다.<br />동일한 귀속연월에 급여 지급이 다수일 경우 계산할 차수를 선택합니다.<br />급여차수는 Self-Customizing > 환경설정 > 사용방법설정 > 관리 에서 설정 가능하며, 사원 등록 시 해당 차수를 등록합니다.</div></td>
        </tr>
        
        <tr>
          <th id="th2">급여구분 <a href="#"><img src="/ECMain/ECount.Common/images/icon_q.gif" width="14px" height="13px" onclick="alert('상여만 지급 횟수를 선택할 수 있습니다.');" alt="" /></a></th>
          <td>
            <span id="lblPayGubun"></span>
            <select name="ddlPayGubun" id="ddlPayGubun" onchange="ChangePayGubun();" style="width:100px;">
	<option value="11">급여</option>
	<option value="31">급(상)여</option>
	<option value="21">상여1회</option>
	<option value="22">상여2회</option>
	<option value="23">상여3회</option>
	<option value="24">상여4회</option>
	<option value="25">상여5회</option>
	<option value="26">상여6회</option>
	<option value="27">상여7회</option>
	<option value="28">상여8회</option>
	<option value="29">상여9회</option>

</select>
		  </td>
		  <td class="info"><div>급여에 상여 포함여부를 선택합니다.<br />각 구분은 급여차수별, 월별로 1회만 선택 가능합니다.</div></td>
        </tr>
        
        <tr>
          <th id="th3">세금계산</th>
          <td>
            <select name="ddlTaxCalc" id="ddlTaxCalc" onchange="ChangeTaxCalc();">
	<option value="0">귀속연월이 동일한 것 합산하여 소득세등 계산</option>
	<option value="1">이번 지급사항만 가지고 소득세등 계산</option>

</select>
		  </td>
		  <td class="info"><div>동일 월에 여러 번 급(상)여 지급 시 소득세 등의 계산 방법을 선택합니다.<br />동일 월에 한 번만 급(상)여 지급 시에는 어떤 것을 선택하여도 동일합니다.</div></td>
        </tr>
        
        <tr>
          <th id="th4">대상기간</th>
          <td>
            <span id="ECDateTimeServer2"><select name="ECDateTimeServer2$ddlWSYear" id="ddlWSYear" onblur="fnlastday(&#39;ddlWSYear&#39;,&#39;ddlWSMonth&#39;,&#39;txtWSDay&#39;);">
	<option value="2018">2018</option>
	<option selected="selected" value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>

</select><select name="ECDateTimeServer2$ddlWSMonth" id="ddlWSMonth" onblur="fnlastday(&#39;ddlWSYear&#39;,&#39;ddlWSMonth&#39;,&#39;txtWSDay&#39;);">
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
	<option selected="selected" value="11">11월</option>
	<option value="12">12월</option>

</select><input name="ECDateTimeServer2$txtWSDay" type="text" value="01" maxlength="2" size="2" id="txtWSDay" class="default" onblur="BlurColor(this); fnlastday(&#39;ddlWSYear&#39;,&#39;ddlWSMonth&#39;,&#39;txtWSDay&#39;);" onkeyup="formatNumber(this.value,&#39;0&#39;,this,&#39;&#39;,2,&#39;&#39;);" style="width:30px;width:20px;" /><img src='/ECMain/EPG/WebResource.axd?d=7PU6sqRt4oWi_hERdGpoHTES4K5-nQ1H5ux7MhbD4YkeMuOXJpRkeKKcCdaA_3H1T6o-30s_7X4l91wwPk9qQ4qw-_Gbd_L1mhIuusw_vB5fR4cZL2oiYjULxaJQ-GK2dE6faC98JApELeTA7lzwDPXbJ3rxBhfcSL3cut89t29bXdtcLn8XCalqd6SZEb5vWdXwLy_j95l28vjxp_vznVocY_A1&t=636467548689085197' id='btnCallCal_ECDateTimeServer2' name='btnCallCal_ECDateTimeServer2' style="cursor:pointer;" onclick='ECCalendar_ECDateTimeServer2.toggle2("btnCallCal_ECDateTimeServer2","N");'/><script type="text/javascript">
var ECCalendar_ECDateTimeServer2;
ECCalendar_ECDateTimeServer2 = new ECCalendar('EcCalendar_ECDateTimeServer2', 'popup', document.getElementById('btnCallCal_ECDateTimeServer2'), 'ECDateTimeServer2', 'ddlWSYear', 'ddlWSMonth', 'txtWSDay', false, 'ko-KR', '2012', '2018', '/ECMain/EPG/WebResource.axd?d=X5hOdRhvxvVUijXPGjy11ChFz1sVsyu6vwkuq_OTHDHte_TDXuYUBlF15yAaSfav01HpJrTMNq-E4uEt9C3QwrnNnuAtRd0C74LkBkgrdTh1sRg2TyQ1B_16Dky9V-viRuxMIinIfM-eWIdCXFXGEX5-3BckStZMdUkYgGc8sKAIdWl8irDLfhSMrITgvRQa22m6umekwIX2imHWXxQaX7P-9bo1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=lUH5gyx3viKwZ61ppIG7FoVJNvzSJhIi7yHttrrdtL6JObWkbhVGT230-WvxeTtlUNdfV2KJGDCTfbXpGPBPMocDgZO3xaJk4LTjpJsIM5gF7dXndlO_aSP3w7-lMDzDyUrzckqu4ulnqNav5nMcKbz4KbaoiKSYkstuH6Exyp4kQoEAEV0ZbP5x_0IH1H3eTDiuCn0-WKSUTdCZN85OZeUgdJw1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=05_EeC2_D5JYjz_0ZYRNOhA8MGxOhVbn7EqBmR49N6eRwkugBVZv4fbgX9h3PwCXIgThN-E64KPG_MFbZLeHyfEwY38gZ4cFQczptNrQ9Gdmqtm1dd5G8lcEGPSvZWONxDmvI6lX6bDNi28pKasqUz3c8KZ2PHf0Ypa1zg3_bGFL-Zx4FFaWwyfSX82fkuxnTLWzDI0sZJe9rUn8y6efmppN2kw1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=3jZmiY6dxhtkKWiBilFYpdItbfNCccHVmle0jJjURpEE58yvnUOtPaUYd2V7N8953PWefx-p6NcK8MU88hA5iXBIqmZxHpAgPCk8aUXryRbl_WgxPKz8pXQce0FByLJG1Zi7kSktrqzJO6e411yUrrtbyI3DeSAj_BhckYz0n4DvehMomXhw24ZxLvywdn8pv134fJPuyAz7tDDQ3rXKtc0C82U1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=mpGJ5x1fF1AMz6abRfFz6M82Xp4oIO0ty9190Zp4FMwNyrHnTQCatdk2bDRI2If038hZQIhhAGVGHbRldz2fGq7OndkaPWALMGu9lhdJQnoRw8v8uew-Uo5LMCX4H6rXjSaxnMHqR5lbwZpL0aRK-S88W6u4PF5fRf7C3Tnm4NyxUQlnEu_HX82H6CiaDzBId-uGleZdCporZLwGmMLAE51lKHQ1&t=636467548689085197');
</script>
</span>
            
            <img src="/ECMain/ECount.Common/Images/icon_to.gif" width="12px" height="18px" /><br />
            <span id="ECDateTimeServer3"><select name="ECDateTimeServer3$ddlWEYear" id="ddlWEYear" onblur="fnlastday(&#39;ddlWEYear&#39;,&#39;ddlWEMonth&#39;,&#39;txtWEDay&#39;);">
	<option value="2018">2018</option>
	<option selected="selected" value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>

</select><select name="ECDateTimeServer3$ddlWEMonth" id="ddlWEMonth" onblur="fnlastday(&#39;ddlWEYear&#39;,&#39;ddlWEMonth&#39;,&#39;txtWEDay&#39;);">
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
	<option selected="selected" value="11">11월</option>
	<option value="12">12월</option>

</select><input name="ECDateTimeServer3$txtWEDay" type="text" value="30" maxlength="2" size="2" id="txtWEDay" class="default" onblur="BlurColor(this); fnlastday(&#39;ddlWEYear&#39;,&#39;ddlWEMonth&#39;,&#39;txtWEDay&#39;);" onkeyup="formatNumber(this.value,&#39;0&#39;,this,&#39;&#39;,2,&#39;&#39;);" style="width:30px;width:20px;" /><img src='/ECMain/EPG/WebResource.axd?d=7PU6sqRt4oWi_hERdGpoHTES4K5-nQ1H5ux7MhbD4YkeMuOXJpRkeKKcCdaA_3H1T6o-30s_7X4l91wwPk9qQ4qw-_Gbd_L1mhIuusw_vB5fR4cZL2oiYjULxaJQ-GK2dE6faC98JApELeTA7lzwDPXbJ3rxBhfcSL3cut89t29bXdtcLn8XCalqd6SZEb5vWdXwLy_j95l28vjxp_vznVocY_A1&t=636467548689085197' id='btnCallCal_ECDateTimeServer3' name='btnCallCal_ECDateTimeServer3' style="cursor:pointer;" onclick='ECCalendar_ECDateTimeServer3.toggle2("btnCallCal_ECDateTimeServer3","N");'/><script type="text/javascript">
var ECCalendar_ECDateTimeServer3;
ECCalendar_ECDateTimeServer3 = new ECCalendar('EcCalendar_ECDateTimeServer3', 'popup', document.getElementById('btnCallCal_ECDateTimeServer3'), 'ECDateTimeServer3', 'ddlWEYear', 'ddlWEMonth', 'txtWEDay', false, 'ko-KR', '2012', '2018', '/ECMain/EPG/WebResource.axd?d=X5hOdRhvxvVUijXPGjy11ChFz1sVsyu6vwkuq_OTHDHte_TDXuYUBlF15yAaSfav01HpJrTMNq-E4uEt9C3QwrnNnuAtRd0C74LkBkgrdTh1sRg2TyQ1B_16Dky9V-viRuxMIinIfM-eWIdCXFXGEX5-3BckStZMdUkYgGc8sKAIdWl8irDLfhSMrITgvRQa22m6umekwIX2imHWXxQaX7P-9bo1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=lUH5gyx3viKwZ61ppIG7FoVJNvzSJhIi7yHttrrdtL6JObWkbhVGT230-WvxeTtlUNdfV2KJGDCTfbXpGPBPMocDgZO3xaJk4LTjpJsIM5gF7dXndlO_aSP3w7-lMDzDyUrzckqu4ulnqNav5nMcKbz4KbaoiKSYkstuH6Exyp4kQoEAEV0ZbP5x_0IH1H3eTDiuCn0-WKSUTdCZN85OZeUgdJw1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=05_EeC2_D5JYjz_0ZYRNOhA8MGxOhVbn7EqBmR49N6eRwkugBVZv4fbgX9h3PwCXIgThN-E64KPG_MFbZLeHyfEwY38gZ4cFQczptNrQ9Gdmqtm1dd5G8lcEGPSvZWONxDmvI6lX6bDNi28pKasqUz3c8KZ2PHf0Ypa1zg3_bGFL-Zx4FFaWwyfSX82fkuxnTLWzDI0sZJe9rUn8y6efmppN2kw1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=3jZmiY6dxhtkKWiBilFYpdItbfNCccHVmle0jJjURpEE58yvnUOtPaUYd2V7N8953PWefx-p6NcK8MU88hA5iXBIqmZxHpAgPCk8aUXryRbl_WgxPKz8pXQce0FByLJG1Zi7kSktrqzJO6e411yUrrtbyI3DeSAj_BhckYz0n4DvehMomXhw24ZxLvywdn8pv134fJPuyAz7tDDQ3rXKtc0C82U1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=mpGJ5x1fF1AMz6abRfFz6M82Xp4oIO0ty9190Zp4FMwNyrHnTQCatdk2bDRI2If038hZQIhhAGVGHbRldz2fGq7OndkaPWALMGu9lhdJQnoRw8v8uew-Uo5LMCX4H6rXjSaxnMHqR5lbwZpL0aRK-S88W6u4PF5fRf7C3Tnm4NyxUQlnEu_HX82H6CiaDzBId-uGleZdCporZLwGmMLAE51lKHQ1&t=636467548689085197');
</script>
</span>
            
          </td>
          <td class="info"><div>해당기간 동안 근무한 사원을 대상으로 급여가 계산됩니다.</div></td>
        </tr>
        <tr>
          <th id="th5">지급일</th>
          <td>
            <span id="ECDateTimeServer4"><select name="ECDateTimeServer4$ddlPayDateYear" id="ddlPayDateYear" onclick="fnChangePayDate();" onchange="fnChangePayDate();" onblur="fnlastday(&#39;ddlPayDateYear&#39;,&#39;ddlPayDateMonth&#39;,&#39;txtPayDateDay&#39;);">
	<option value="">====</option>
	<option value="2018">2018</option>
	<option selected="selected" value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>

</select><select name="ECDateTimeServer4$ddlPayDateMonth" id="ddlPayDateMonth" onclick="fnChangePayDate();" onchange="fnChangePayDate();" onblur="fnlastday(&#39;ddlPayDateYear&#39;,&#39;ddlPayDateMonth&#39;,&#39;txtPayDateDay&#39;);">
	<option value="">==</option>
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
	<option selected="selected" value="11">11월</option>
	<option value="12">12월</option>

</select><input name="ECDateTimeServer4$txtPayDateDay" type="text" value="23" maxlength="2" size="2" id="txtPayDateDay" class="default" onblur="BlurColor(this); fnlastday(&#39;ddlPayDateYear&#39;,&#39;ddlPayDateMonth&#39;,&#39;txtPayDateDay&#39;);" onkeyup="formatNumber(this.value,&#39;0&#39;,this,&#39;&#39;,2,&#39;&#39;);" style="width:30px;width:20px;" /><img src='/ECMain/EPG/WebResource.axd?d=7PU6sqRt4oWi_hERdGpoHTES4K5-nQ1H5ux7MhbD4YkeMuOXJpRkeKKcCdaA_3H1T6o-30s_7X4l91wwPk9qQ4qw-_Gbd_L1mhIuusw_vB5fR4cZL2oiYjULxaJQ-GK2dE6faC98JApELeTA7lzwDPXbJ3rxBhfcSL3cut89t29bXdtcLn8XCalqd6SZEb5vWdXwLy_j95l28vjxp_vznVocY_A1&t=636467548689085197' id='btnCallCal_ECDateTimeServer4' name='btnCallCal_ECDateTimeServer4' style="cursor:pointer;" onclick='ECCalendar_ECDateTimeServer4.toggle2("btnCallCal_ECDateTimeServer4","N");'/><script type="text/javascript">
var ECCalendar_ECDateTimeServer4;
ECCalendar_ECDateTimeServer4 = new ECCalendar('EcCalendar_ECDateTimeServer4', 'popup', document.getElementById('btnCallCal_ECDateTimeServer4'), 'ECDateTimeServer4', 'ddlPayDateYear', 'ddlPayDateMonth', 'txtPayDateDay', false, 'ko-KR', '2012', '2018', '/ECMain/EPG/WebResource.axd?d=X5hOdRhvxvVUijXPGjy11ChFz1sVsyu6vwkuq_OTHDHte_TDXuYUBlF15yAaSfav01HpJrTMNq-E4uEt9C3QwrnNnuAtRd0C74LkBkgrdTh1sRg2TyQ1B_16Dky9V-viRuxMIinIfM-eWIdCXFXGEX5-3BckStZMdUkYgGc8sKAIdWl8irDLfhSMrITgvRQa22m6umekwIX2imHWXxQaX7P-9bo1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=lUH5gyx3viKwZ61ppIG7FoVJNvzSJhIi7yHttrrdtL6JObWkbhVGT230-WvxeTtlUNdfV2KJGDCTfbXpGPBPMocDgZO3xaJk4LTjpJsIM5gF7dXndlO_aSP3w7-lMDzDyUrzckqu4ulnqNav5nMcKbz4KbaoiKSYkstuH6Exyp4kQoEAEV0ZbP5x_0IH1H3eTDiuCn0-WKSUTdCZN85OZeUgdJw1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=05_EeC2_D5JYjz_0ZYRNOhA8MGxOhVbn7EqBmR49N6eRwkugBVZv4fbgX9h3PwCXIgThN-E64KPG_MFbZLeHyfEwY38gZ4cFQczptNrQ9Gdmqtm1dd5G8lcEGPSvZWONxDmvI6lX6bDNi28pKasqUz3c8KZ2PHf0Ypa1zg3_bGFL-Zx4FFaWwyfSX82fkuxnTLWzDI0sZJe9rUn8y6efmppN2kw1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=3jZmiY6dxhtkKWiBilFYpdItbfNCccHVmle0jJjURpEE58yvnUOtPaUYd2V7N8953PWefx-p6NcK8MU88hA5iXBIqmZxHpAgPCk8aUXryRbl_WgxPKz8pXQce0FByLJG1Zi7kSktrqzJO6e411yUrrtbyI3DeSAj_BhckYz0n4DvehMomXhw24ZxLvywdn8pv134fJPuyAz7tDDQ3rXKtc0C82U1&t=636467548689085197', '/ECMain/EPG/WebResource.axd?d=mpGJ5x1fF1AMz6abRfFz6M82Xp4oIO0ty9190Zp4FMwNyrHnTQCatdk2bDRI2If038hZQIhhAGVGHbRldz2fGq7OndkaPWALMGu9lhdJQnoRw8v8uew-Uo5LMCX4H6rXjSaxnMHqR5lbwZpL0aRK-S88W6u4PF5fRf7C3Tnm4NyxUQlnEu_HX82H6CiaDzBId-uGleZdCporZLwGmMLAE51lKHQ1&t=636467548689085197');
</script>
</span>
             
          </td>
          <td class="info"><div>실제 급여 지급일자 입니다.</div></td>
        </tr>
        <tr>
          <th id="th6">지급연월</th>
          <td>
            <span id="ECDateTimeServer5"><select name="ECDateTimeServer5$ddlRYear" id="ddlRYear">
	<option selected="selected" value="">====</option>
	<option value="2018">2018</option>
	<option value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>

</select><select name="ECDateTimeServer5$ddlRMonth" id="ddlRMonth">
	<option selected="selected" value="">==</option>
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
	<option value="12">12월</option>

</select><input name="ECDateTimeServer5$txtDay_ECDateTimeServer5" type="text" maxlength="2" size="2" id="txtDay_ECDateTimeServer5" style="width:20px;display:none;" /></span>
            
		  </td>
          <td class="info"><div>원천징수이행상황 신고서에 반영되는 지급연월을 선택합니다.<br />지급연월의 다음달 10일에 신고합니다.</div></td>
        </tr>
        <tr id="trBonus1" style="display: none;">
            <th rowspan="4">상<br />여</th>
            <th>변동급자<br />기본시간</th>
            <td>
                <input name="txtBonusDay" type="text" maxlength="3" id="txtBonusDay" class="defaultright" style="width:40px;" />시간
            </td>
            <td class="info"><div>변동급자의 상여 계산 시 기준이 되는 시간을 입력합니다.<br />주 40시간 기준: 일반적으로 209시간을 입력합니다.<br />30일 기준: 일반적으로 240시간을 입력합니다.</div></td>
        </tr>
        <tr id="trBonus2" style="display: none;">
            <th>정산기간</th>
            <td>
                <span id="ECDateTimeServer6"><select name="ECDateTimeServer6$ddlYymmFYear" id="ddlYymmFYear">
	<option value="2018">2018</option>
	<option selected="selected" value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>

</select><select name="ECDateTimeServer6$ddlYymmFMonth" id="ddlYymmFMonth">
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
	<option selected="selected" value="11">11월</option>
	<option value="12">12월</option>

</select><input name="ECDateTimeServer6$txtDay_ECDateTimeServer6" type="text" maxlength="2" size="2" id="txtDay_ECDateTimeServer6" style="width:20px;display:none;" /></span>
                
                <img src="/ECMain/ECount.Common/Images/icon_to.gif" width="12px" height="18px" />
                <span id="ECDateTimeServer7"><select name="ECDateTimeServer7$ddlYymmTYear" id="ddlYymmTYear" style="display:none;">
	<option value="2018">2018</option>
	<option selected="selected" value="2017">2017</option>
	<option value="2016">2016</option>
	<option value="2015">2015</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
	<option value="2012">2012</option>

</select><select name="ECDateTimeServer7$ddlYymmTMonth" id="ddlYymmTMonth">
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
	<option selected="selected" value="11">11월</option>
	<option value="12">12월</option>

</select><input name="ECDateTimeServer7$txtDay_ECDateTimeServer7" type="text" maxlength="2" size="2" id="txtDay_ECDateTimeServer7" style="width:20px;display:none;" /></span>
                
            </td>
            <td class="info"><div>정산기간은 소득세 계산 시 상여 지급월의 세금이 많아 일정기간의 세금을 다시 계산하는 기능입니다.<br />일반적으로 직전 상여 지급월의 익월부터 금번 지급월을 선택합니다.</div></td>
        </tr>        
        <tr id="trBonus3" style="display: none;">
            <th>지급률(액)</th>
            <td>
                <span id="rbPayRateFlag" name="rbPayRateFlag" onclick="ChangePayRateFlag();"><input id="rbPayRateFlag_0" type="radio" name="rbPayRateFlag" value="0" checked="checked" /><label for="rbPayRateFlag_0">지급률(%)&nbsp;&nbsp;</label><input id="rbPayRateFlag_1" type="radio" name="rbPayRateFlag" value="1" /><label for="rbPayRateFlag_1">지급액</label></span><br />
                <span id="divPayRate1">
                <input name="txtPayRate" type="text" id="txtPayRate" class="defaultright" style="width:50px;" />%
                </span>
                <span id="divPayRate2" style="display: none;">
                <input name="txtBonusAmt" type="text" id="txtBonusAmt" class="defaultright" style="width:50px;" />
                </span>
                (<input id="cbBonusFlag" type="checkbox" name="cbBonusFlag" /> 상여합산)
            </td>
            <td class="info"><div>상여지급 기준을 설정합니다.<br />상여 지급률(액)에 차이가 있는 경우 개인별로 수정 가능합니다.<br />상여합산 체크시 개별 수당항목 금액이 상여란으로 합산되어 표시되고 과세처리됩니다.</div></td>
        </tr>        
        <tr id="trBonus4" style="display: none;">
            <th>상여구분</th>   
            <td>
                <span id="rbBonusApplyFlag"><input id="rbBonusApplyFlag_0" type="radio" name="rbBonusApplyFlag" value="0" checked="checked" /><label for="rbBonusApplyFlag_0">급여대장기준&nbsp;&nbsp;</label><input id="rbBonusApplyFlag_1" type="radio" name="rbBonusApplyFlag" value="1" /><label for="rbBonusApplyFlag_1">사원등록기준</label></span><br />
            </td>
            <td class="info"><div>야간근로수당 월정액 150만원 계산 시 상여금액의 포함 여부를 설정합니다. 급여대장기준 선택 시 비고정적 상여로써 월정액 계산에서 제외됩니다.</div></td>
        </tr>        
        <tr>
          <th id="th7">연말정산 <a href="#"><img src="/ECMain/ECount.Common/images/icon_q.gif" width="14px" height="13px" onclick="alert('이카운트를 통해 계산처리된 연말정산 내역 중, 선택한 연도의 연말정산 공제/환급액을 [기본사항등록] > [공제항목등록]에서 (21) 연말정산 항목으로 불러옵니다. (연말정산 항목에 표시 순서가 입력되어 있을때 적용됩니다.)');" alt="" /></a></th>
          <td>
            <span id="ECDateTimeServer8"><select name="ECDateTimeServer8$ddlAdjustYy" id="ddlAdjustYy">
	<option selected="selected" value="">====</option>
	<option value="2016">2016</option>

</select><select name="ECDateTimeServer8$ddlMonth_ECDateTimeServer8" id="ddlMonth_ECDateTimeServer8" style="display:none;">
	<option selected="selected" value="01">1월</option>
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
	<option value="12">12월</option>

</select><input name="ECDateTimeServer8$txtDay_ECDateTimeServer8" type="text" maxlength="2" size="2" id="txtDay_ECDateTimeServer8" style="width:20px;display:none;" /></span>
            
		  </td>
          <td class="info"><div>급여대장 작성 시 연말정산과 관련된 환급세액 등을 반영할 수 있습니다.</div></td>
        </tr>
        <tr>
            <th id="th9">급여대장명칭</th><!-- 급여대장명칭-->
            <td><input name="txtPayDes" type="text" maxlength="30" id="txtPayDes" class="default" style="width:200px;" /></td>
            <td class="info"><div>급여대장 및 급여명세서에 인쇄될 명칭을 입력합니다.</div></td>
        </tr>
        <tr>
          <th id="th8">급여명세서<br />하단</th>
          <td><input name="txtPayComment" type="text" value="※수고하셨습니다" maxlength="100" id="txtPayComment" class="default" style="width:200px;" /></td>
          <td class="info"><div>급여명세서 하단에 인쇄할 내용을 입력합니다.</div></td>
        </tr>
							</table>    
					</form>
				</div>
			</div><!-- /.row -->

			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="fnSave();">
						<i class="ace-icon fa fa-minus-square bigger-110"></i>
						저장
					</button>

					<button class="btn " type="button" onclick="gfnClose()">
						<i class="ace-icon fa fa-minus-square bigger-110"></i>
						닫기
					</button>

					<button class="btn" type="reset" onclick="gfnDelete()">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						삭제
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<?
require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->
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
        // 사용방법설정 팝업창 높이

        
        function ChangePayGubun()
        {
            var strPayGubun = $("#ddlPayGubun option:selected").val();
            
            if (strPayGubun != 11)
            {
                if('I'=='I')
                    $("#txtBonusDay").val("209");
                $("#txtBonusDay").attr("disabled", "");
                
                if (strPayGubun == 31)
                    $("#cbBonusFlag").attr("disabled", "disabled");
                else
                    $("#cbBonusFlag").attr("disabled", "");
                    
                $("#col1").css("width", "3%");
                $("#col2").css("width", "9%");
                $("#col3").css("width", "35%");
                
                for(var i = 1; i <= 9; i++)
                {
                    $("#th" + i).attr("colSpan", 2);
                }                
            }
            else
            {
                $("#cbBonusFlag").attr("disabled", "disabled");
                $("#txtBonusDay").attr("disabled", "disabled");
                $("#col1").css("width", "12%");
                $("#col2").css("width", "35%");
                $("#col3").css("width", "");
                
                for(var i = 1; i <= 9; i++)
                {
                    $("#th" + i).attr("colspan", "");
                }
            }            
            
            for(var i = 1; i <=4 ; i++)
            {
                if (strPayGubun > 11)
                    $("#trBonus" + i).show();
                else
                    $("#trBonus" + i).hide();
            }
            
            SelectDay(1);
        }
        
        function SelectDay(strGubun)
        {
            if (strGubun == 1)
            {
                var strTaxCalc = $("#ddlTaxCalc option:selected").val();
                var strPayGubun = $("#ddlPayGubun option:selected").val();
                
                if (strTaxCalc == "1" && strPayGubun != "11")
                {
                    // 정산기간
                    $("#ddlYymmFYear option[value=" + $("#ddlPYear option:selected").val() + "]").attr("selected", "true");
                    $("#ddlYymmFMonth option[value=" + $("#ddlPMonth option:selected").val() + "]").attr("selected", "true");
                    $("#ddlYymmTYear option[value=" + $("#ddlPYear option:selected").val() + "]").attr("selected", "true");
                    $("#ddlYymmTMonth option[value=" + $("#ddlPMonth option:selected").val() + "]").attr("selected", "true");
                    
                    $("#ddlYymmFYear").attr("disabled", "disabled");
                    $("#ddlYymmFMonth").attr("disabled", "disabled");
                    $("#ddlYymmTYear").attr("disabled", "disabled");
                    $("#ddlYymmTMonth").attr("disabled", "disabled");
                }
                else
                {
                    $("#ddlYymmFYear").attr("disabled", "");
                    $("#ddlYymmFMonth").attr("disabled", "");
                    $("#ddlYymmTYear").attr("disabled", "");
                    $("#ddlYymmTMonth").attr("disabled", "");                
                }
            }
            else
            {
                if($("#ddlRYear option:selected").val() != $("#ddlPayDateYear option:selected").val())
                {
                    $("#ddlRYear option[value=" + $("#ddlPayDateYear option:selected").val() + "]").attr("selected", "true");
                }
                
                if($("#ddlRMonth option:selected").val() != $("#ddlPayDateMonth option:selected").val())
                {
                    $("#ddlRMonth option[value=" + $("#ddlPayDateMonth option:selected").val() + "]").attr("selected", "true");
                }
            }
        }
        
        function ChangePayRateFlag()
        {
            if ($("#rbPayRateFlag :checked").val() == "0")
            {
                $("#divPayRate1").show();
                $("#divPayRate2").hide();
            }
            else
            {
                $("#divPayRate1").hide();
                $("#divPayRate2").show();
            }
        }
        
        function ChangeTaxCalc()
        {
            var strTaxCalc = $("#ddlTaxCalc option:selected").val();
            
            if (strTaxCalc == "1")
            {
                $("#ddlYymmFYear").attr("disabled", "disabled");
                $("#ddlYymmFMonth").attr("disabled", "disabled");
                $("#ddlYymmTYear").attr("disabled", "disabled");
                $("#ddlYymmTMonth").attr("disabled", "disabled");
            }
            else
            {
                $("#ddlYymmFYear").attr("disabled", "");
                $("#ddlYymmFMonth").attr("disabled", "");
                $("#ddlYymmTYear").attr("disabled", "");
                $("#ddlYymmTMonth").attr("disabled", "");                
            }        
        }

        //F8 단축키 이벤트
        function Click_F8() {
           /*if ("W" == "R") {
                alert("읽기 권한자는 사용할 수 없는 기능입니다.");
                return false;
            }
            else if ("W" == "U" && "I" == "M") {
                alert("수정 권한이 없습니다.");
                return false; 

            } */
            
            if ("W" != "W"){
                alert("권한이 없습니다.");
                return false;
            }
            fnSave('');
        }
        
        // 저장
        function fnSave(strSaveType) {
           /* if ("W" == "R") {
                alert("읽기 권한자는 사용할 수 없는 기능입니다.");
                return false;
            }
            else if ("W" == "U" && "I" == "M") {
                alert("수정 권한이 없습니다.");
                return false;
            }
          */
            
                if ("W" != "W" && "W" != "U"){
                    alert("권한이 없습니다.");
                    return false;
                }
            
            var strPayGubun = $("#ddlPayGubun option:selected").val();
            
            
            
            if (strPayGubun != "11")
            {
                var strBonusRate = "";
                var strBonusAmt = "";
                
                if ($("#txtPayRate").val() == "")
                    strBonusRate = 0;
                else
                    strBonusRate = numOffMask($("#txtPayRate").val());
                    
                if ($("#txtBonusAmt").val() == "")
                    strBonusAmt = 0;
                else
                    strBonusAmt = numOffMask($("#txtBonusAmt").val());
                    
                if (strBonusRate == 0 && strBonusAmt == 0)
                {
                    alert("상여 지급률이나 지급액이 입력되지 않았습니다.");

                    if ($("#rbPayRateFlag_0").is(":checked"))
                        $("#txtPayRate").focus();
                    else
                        $("#txtBonusAmt").focus();
                        
                    return false;
                }
            }
            
            
            
            // 대상기간FROM
            var strWSYear = $("#ddlWSYear option:selected").val();
            var strWSMonth = $("#ddlWSMonth option:selected").val();
            var strWSDay = $("#txtWSDay").val();
            
            // 대상기간TO
            var strWEYear = $("#ddlWEYear option:selected").val();
            var strWEMonth = $("#ddlWEMonth option:selected").val();
            var strWEDay = $("#txtWEDay").val();            
            
            // 지급일자
            var strPayDateYear = $("#ddlPayDateYear option:selected").val();
            var strPayDateMonth = $("#ddlPayDateMonth option:selected").val();
            var strPayDateDay = $("#txtPayDateDay").val();
            
            if (strPayDateDay == "" || Number(strPayDateDay) == 0)
            {
                alert("MSG01968");
                $("#txtPayDateDay").focus();
                return false;
            }
            else
            {
                if (checkDate(strWSYear, strWSMonth, strWSDay) == -1)
                {
                    alert("대상기간의 시작일자를 다시 입력 바랍니다.");
                    $("#txtWSDay").focus();
                    return false;
                }
                
                if (checkDate(strWEYear, strWEMonth, strWEDay) == -1)
                {
                    alert("대상기간의 종료일자를 다시 입력 바랍니다.");
                    $("#txtWEDay").focus();
                    return false;
                }                
                
                if (strWSYear + strWSMonth + strWSDay > strWEYear + strWEMonth + strWEDay)
                {
                    alert("대상기간의 시작일자가 종료일자 보다 큽니다.\n\n대상기간을 확인 바랍니다.");
                    $("#ddlWSYear").focus();
                    return false;
                }
                
                if (checkDate(strPayDateYear, strPayDateMonth, strPayDateDay) == -1)
                {
                    alert("지급일을 다시 입력 바랍니다.");
                    $("#txtPayDateDay").focus();
                    return false;
                }    

                if (strWSYear + strWSMonth + strWSDay > strPayDateYear + strPayDateMonth + strPayDateDay)
                {
                    alert("지급일은 대상기간의 시작일보다 작을 수 없습니다.\n\n대상기간과 지급일을 확인 바랍니다.");
                    $("#ddlPayDateYear").focus();
                    return false;
                }
            }
            
            // 지급연월
            var strRYear = $("#ddlRYear option:selected").val();
            var strRMonth = $("#ddlRMonth option:selected").val();
            
            if (strRYear == "" || strRMonth == "")
            {
                alert("지급연월을 선택 바랍니다.");
                if (strRYear == "")
                    $("#ddlRYear").focus();
                else
                    $("#ddlRMonth").focus();
                return false;
            }
            else
            {
                if (strPayDateMonth == "01") {
                    strPayDateMonth = "12";
                    strPayDateYear = strPayDateYear - 1;
                }else {
                    strPayDateMonth = Number(strPayDateMonth) - 1;
                }
                
                if (strPayDateMonth < 10) {
                    strPayDateMonth = "0"+strPayDateMonth
                }
                
                if (strRYear + strRMonth < strPayDateYear + strPayDateMonth)
                {
                    alert("지급연월은 지급일보다 크거나 같아야 합니다.");
                    $("#ddlPayDateYear").focus();
                    return false;
                }
            }
            
            // 정산기간
            $("#ddlYymmTYear option[value=" + $("#ddlYymmFYear option:selected").val() + "]").attr("selected", "true"); // 정산시작기간 년도를 종료년도랑 똑같이 해줌.
            var strYymmFYear = $("#ddlYymmFYear option:selected").val();
            var strYymmFMonth = $("#ddlYymmFMonth option:selected").val();
            var strYymmTMonth = $("#ddlYymmTMonth option:selected").val();
            
            if (strPayGubun != "11" && strYymmFMonth > strYymmTMonth)
            {
                alert("정산기간의 시작월이 종료월보다 큽니다.\n\n정산기간을 확인 바랍니다.");
                $("#ddlYymmTMonth").focus();
                return false;
            }
            
            if (strPayGubun != "11") // 상여대장일 경우
            {
                if ($("#rbPayRateFlag :checked").val() == "0") // 지급율이면 지급액을 0으로 변경
                    $("#txtBonusAmt").val("0");
                else // 지급액이라면 지급율을 0으로.
                    $("#txtPayRate").val("0");
            }
            
            // 귀속연월
            var strPSYear = $("#ddlPYear option:selected").val();
            var strPSMonth = $("#ddlPMonth option:selected").val();
            
            if (strPayGubun != "11")
            {
                if (strYymmFYear != strPSYear)
                {
                    alert("상여의 정산연도는 귀속연도와 같아야 합니다.");
                    $("#ddlYymmFYear").focus();
                    return false;
                }
                
                if (strYymmTMonth > strPSMonth)
                {
                    alert("상여의 정산 종료월은 귀속월보다 작거나 같아야 합니다.");
                    $("#ddlYymmTMonth").focus();
                    return false;
                }                
            }
            
            if (strSaveType == "calc" && "2016" > strPSYear) // 계산처리 시
            {
                alert("2016년 이전은 계산처리를 할 수 없습니다.");
                return false;
            }
            //정산기간
            $("#ddlYymmFYear").attr("disabled", "");
            $("#ddlYymmFMonth").attr("disabled", "");
            $("#ddlYymmTYear").attr("disabled", "");
            $("#ddlYymmTMonth").attr("disabled", "");
            
            $("#hidSaveType").val(strSaveType);
                        
            fnSubmit();
        }
        
        // 삭제
        function fnDelete() {
            if (confirm("삭제하겠습니까?"))
            {
                $("#hidEditFlag").val("D");
                fnSubmit();                
                return;
            }

            return false;
        }        
        
        function fnSubmit() {
            $("#form")
            .attr("method", "post")
            //.attr("target", "EPG013M")
            .attr("action", fnSetUrlPath("EPG013M_SAVE.aspx", "ec_req_sid"))
            .submit(); 
        }

        //F2 단축키 이벤트
        function Click_F2() {
            fnNew();
        }

        //부모창 Submit
        function fnOpenerSubmit() {
            var dom = parseXML(document.getElementById("hidSearchXml").value);
            var StartWeek = $(dom).find("FirstFlag").text();
            
            if (StartWeek == "Y") {
                opener.location.href = fnSetUrlPath("EPG012M.aspx", "ec_req_sid");
            }
            else {
                var sumFlag = $(dom).find("cbSumFlag").text();

                if (sumFlag == "Y") {
                    sumFlag = "N";                                      
                }

                opener.frmSearchData(true, sumFlag);
            }
        }

        // 신규등록
        function fnNew() {
            document.body.insertAdjacentHTML("beforeEnd", "<iframe name=frmNew width=0 height=0></iframe>");
            var doc = frmNew.document;
            doc.open();
            doc.write("<body>");
            //급여계산>신고귀속클릭>신규입력시 
                doc.write(" <form name='form' method='post' action=" + fnSetUrlPath('EPG013M.aspx', 'ec_req_sid') + " target='EPG013M'><input type='hidden' id='hidPop2' name='hidPop2' value='Y' /> ");
            
            doc.write(" <input type='hidden' id='hidSearchXml' name='hidSearchXml' />");
            doc.write(" <script language=\"javascript\" type=\"text/javascript\">");
            doc.write(" document.getElementById('hidSearchXml').value = parent.document.getElementById('hidSearchXml').value;");
            doc.write(" document.form.submit(); ");
            doc.write(" </script>");
            doc.write("</body> ");
            doc.close();
        }


        
        // 비과세재계산
        function fnNonTax() {
            if ("W" != "W") {
                alert("읽기 권한자는 사용할 수 없는 기능입니다.");
                return false;
            }
            
            var strPayGubun = $("#ddlPayGubun option:selected").val();
            if($("#hidOldpaygubun").get(0).value !=  strPayGubun)       
            {
                alert("저장(F8)후, 비과세재계산 해 주세요");
                return false;
            }
            __doPostBack("lnkPayNonTax", "");
            return false;
        }        

        // 리스트
        function fnList() {
            $("#form")
            .attr("method", "post")
            .attr("action", fnSetUrlPath("EPG012M.aspx", "ec_req_sid"))
            .submit();
        }

        //지급일 변경시 지급년월 년월 같도록 처리
        function fnChangePayDate() {
            var strPSYear = $("#ddlPayDateYear option:selected").val();
            var strPSMonth = $("#ddlPayDateMonth option:selected").val();
            
            $("#ddlRYear > option[value="+strPSYear+"]").attr("selected", "true");
            $("#ddlRMonth > option[value="+strPSMonth+"]").attr("selected", "true");
        }

        
        $(document).ready(function() {
            SetElementEvent();
            ChangePayGubun();
            ChangePayRateFlag();
            
            
            $("#ddlPYear").focus();
            

            checkSetupList();
        });

        // 사용방법설정 설정값이 존재하는지 확인
	    function checkSetupList() {           
		    var param = { PROGRAM_SEQ : 917 };
		
		     $.ajax({
			    type: "POST",
			    dataType: "json",
			    data: JSON.stringify(param),
			    contentType: 'application/json',
			    async:false,
			    url: fnSetUrlPath("/ECAPI/SelfCustomize/Config/GetListSelfCustomizeSetup", "ec_req_sid"),        
			    error: function(errorMsg) {
				    alert('에러발생'+'\nfnGetData:' + errorMsg);            
			    },
			    success: function(returnData) {                     
				    if(returnData.Status == "200" && returnData.Data.Height != 0) {
					    if ($(".title-rightarea").length  == 0 ){
						    $(".new-title").append(' <div class="title-rightarea"><span class="btn-setting" onclick="fnShowOption(); return false;"></span><ul class="option_box_new" ><li id="scPopup"><a onclick="fnSelfCustomizing();">사용방법설정</a></li></ul></div>');
					    } else if ($(".title-rightarea > ul li").length  > 0) {
						    $(".title-rightarea > ul").append('<li id="scPopup"><a onclick="fnSelfCustomizing();">사용방법설정</a></li>');
					    }
                        // 팝업창 사이즈 조절
                        selfCustomizingHeight = returnData.Data.Height+ 50;
				    }
			    }
		    });      
	    }

        //사용방법설정
        function fnSelfCustomizing() {
	        var url = "/ECERP/ESC/ESC002M";    
	        gfnpopSubmit("frmSC", url, "frmSC", "yes", "750", selfCustomizingHeight);
	        return false;
        }
    //-->
    </script>

<!----------------------------------------------------------------------------------------------------------------------->