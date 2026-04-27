<?
	if ($yy_t == "") $yy_t=date('Y');
	$a_qry = " SELECT * from erp_salary_itme where yy_t='".$yy_t."'";
	$result = mysql_query($a_qry);  // echo($a_qry);
	$num_rows = mysql_num_rows($result);
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
		<form name="form1" id="form1" method="post" action="index.php">
		<input type="hidden" name="controller" id="controller" value="salary" />
		<?if($num_rows>"0"){?>
		<input type="hidden" name="action" id="action" value="registSalaryItmeUpdate" />
		<?}else{?>
		<input type="hidden" name="action" id="action" value="registSalaryItmeInsert" />
		<?}?>
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
							<option value="2024" <? if ($yy_t=="2024" || date('Y')=="2024") echo "selected"?>>2024</option>
							<option value="2023" <? if ($yy_t=="2023" || date('Y')=="2023") echo "selected"?>>2023</option>
							<option value="2022" <? if ($yy_t=="2022" || date('Y')=="2022") echo "selected"?>>2022</option>
							<option value="2021" <? if ($yy_t=="2021" || date('Y')=="2021") echo "selected"?>>2021</option>
                            <option value="2020" <? if ($yy_t=="2020" || date('Y')=="2020") echo "selected"?>>2020</option>
		                    <option value="2019" <? if ($yy_t=="2019" || date('Y')=="2019") echo "selected"?>>2019</option>
							<option value="2018" <? if ($yy_t=="2018" || date('Y')=="2018") echo "selected"?>>2018</option>
		                    <option value="2017" <? if ($yy_t=="2017" || date('Y')=="2017") echo "selected"?>>2017</option>
		                    <option value="2016" <? if ($yy_t=="2016" || date('Y')=="2016") echo "selected"?>>2016</option>
		                    <option value="2015" <? if ($yy_t=="2015" || date('Y')=="2015") echo "selected"?>>2015</option>
		                    <option value="2014" <? if ($yy_t=="2014" || date('Y')=="2014") echo "selected"?>>2014</option>
		                    <option value="2013" <? if ($yy_t=="2013" || date('Y')=="2013") echo "selected"?>>2013</option>
		                    <option value="2012" <? if ($yy_t=="2012" || date('Y')=="2012") echo "selected"?>>2012</option>
		                    <option value="2011" <? if ($yy_t=="2011" || date('Y')=="2011") echo "selected"?>>2011</option>
		                    <option value="2010" <? if ($yy_t=="2010" || date('Y')=="2010") echo "selected"?>>2010</option>
                        </select>
                        <input name="btnSearch" class="btn_searchS" id="btnSearch" onclick="yy_reload();" type="button" value="검색">
                    </p>  
                </div>
			</div>		
				<table id="simple-table" class="table  table-bordered table-hover">
					<colgroup>
					<col style="width: 15%;">
					<col style="width: 5%;">
					<col style="width: 4%;">
					<col style="width: 4%;">
					<col style="width: 7%;">
					<col style="width: 5%;">
					<col style="width: 15%;">
					<col style="width: 15%;">
					<col style="width: 5%;">
					<col style="width: 10%;">
					<col style="width: 15%;">
                    <thead>
                        <tr>
                            <th class="center">수당명</th>
                            <th class="center">표시순서</th>
                            <th class="center">고정급<br>상여</th>
                            <th class="center">변동급<br>상여</th>
                            <th class="center">근무기록<a onclick="Message('daily');" href="#"></th>
                            <th class="center">배율<a onclick="Message('rate');" href="#"></th>
                            <th class="center">비과세<a onclick="Message('nontax');" href="#"></th>
                            <th class="center">계산식<a onclick="Message('calc');" href="#"></th>
                            <th class="center">계산항목</th>
                            <th class="center">계산내역</th>
                            <th class="center">근태(휴가)코드</th>
                        </tr>
                    </thead>
                    <tbody>
						<?

							if($num_rows>0){
								$t="1";
							for($i=0; $arow=mysql_fetch_array($result); $i++) {
								$uid				=$arow["uid"];
								$a_des				=$arow["a_des"];
								$a_sort				=$arow["a_sort"];
								$a_bonus			=$arow["a_bonus"];
								$a_bonus1			=$arow["a_bonus1"];
								$a_daily			=$arow["a_daily"];
								$a_rate				=$arow["a_rate"];
								$a_nontax			=$arow["a_nontax"];
								$a_nontax_cd		=$arow["a_nontax_cd"];
								$a_nontax_des		=$arow["a_nontax_des"];
								$calc1				=$arow["calc1"];
								$calc2				=$arow["calc2"];
								$calc_flag			=$arow["calc_flag"];
								$calc_des			=$arow["calc_des"];
								$attend_cd			=$arow["attend_cd"];
								$attend_des			=$arow["attend_des"];
								$yy_t				=$arow["yy_t"];
								$attend_gubun		=$arow["attend_gubun"];

								if ($a_sort ==""){
									$a_sort ="0";
								}
								if ($a_bonus ==""){
									$a_bonus ="0";
								}
								if ($a_bonus1 ==""){
									$a_bonus1 ="0";
								}
								if ($a_daily ==""){
									$a_daily ="0";
								}
								if ($calc_flag ==""){
									$calc_flag ="0";
								}

							?>
							<tr>
								<td>[<?=$t?>] <input name="a_des_<?=$t?>" class="bluebox" id="a_des_<?=$t?>" onfocus="this.select();" type="text" maxlength="20" value="<?=$a_des?>"></td>
								<td class="center"><input name="a_sort_<?=$t?>" class="text-right" id="a_sort_<?=$t?>" style="width: 50px;" onkeypress="num_check();" onfocus="this.select();" type="text" maxlength="2" value="<?=$a_sort?>"></td>
								<td class="center"><input name="a_bonus_<?=$t?>" class="checkbox" id="a_bonus_<?=$t?>" type="checkbox" value="<?=$a_bonus?>" <? if ($a_bonus=="1") echo "checked='checked'"?> ></td>
								<td class="center"><input name="a_bonus1_<?=$t?>" class="checkbox" id="a_bonus1_<?=$t?>" type="checkbox" value="<?=$a_bonus1?>" <? if ($a_bonus1=="1") echo "checked='checked'"?> ></td>
								<td>
									<select name="a_daily_<?=$t?>" class="center" id="a_daily_<?=$t?>" style="width:105px;" onchange="fnSetValue(this.value,'<?=$t?>');">
										<option value="0" <? if ($a_daily=="0") echo "selected"?> >고정</option>
										<option value="1" <? if ($a_daily=="1") echo "selected"?>>변동(일)</option>
										<option value="2" <? if ($a_daily=="2") echo "selected"?>>변동(시간)</option>
										<option value="3" <? if ($a_daily=="3") echo "selected"?>>변동(지급률)</option>
									</select>
								</td>
								<td class="center"><input name="a_rate_<?=$t?>" class="text-right" id="a_rate_<?=$t?>" style="width: 40px;" onkeyup="text_check('a_rate_<?=$t?>','5');" type="text" maxlength="5" value="<?=$a_rate?>"></td>
								<td class="center"><input name="a_nontax_<?=$t?>" id="a_nontax_<?=$t?>" type="hidden" value="<?=$a_nontax?>"><input name="a_nontax_cd_<?=$t?>" onfocus="this.select();" class="bluebox" id="a_nontax_cd_<?=$t?>" style="width: 40px;" ondblclick="search_code('1', '<?=$t?>', 'double');" onchange="search_code('1', '<?=$t?>', '');" type="text" value="<?=$a_nontax_cd?>"> <input name="a_nontax_des_<?=$t?>" class="default" id="a_nontax_des_<?=$t?>" onfocus="this.select();" style="width: 120px;" type="text" readonly="readonly" value="<?=$a_nontax_des?>"></td>
								<td class="center">
									<select name="calc1_<?=$t?>" id="calc1_<?=$t?>" style="width: 80px;" >
										<option value="01" <? if ($calc1=="01") echo "selected"?>>원</option>
										<option value="10" <? if ($calc1=="10") echo "selected"?>>십원</option>
										<option value="21" <? if ($calc1=="21") echo "selected"?>>소수점1</option>
										<option value="22" <? if ($calc1=="22") echo "selected"?>>소수점2</option>
									</select>  
									<select name="calc2_<?=$t?>" id="calc2_<?=$t?>" style="width: 80px;">
										<option value="R" <? if ($calc2=="R") echo "selected"?>>반올림</option>
										<option value="C" <? if ($calc2=="C") echo "selected"?>>절상</option>
										<option value="F" <? if ($calc2=="F") echo "selected"?>>절사</option>
									</select>
								</td>
								<td class="center"><input name="calc_flag_<?=$t?>" class="checkbox" id="calc_flag_<?=$t?>" onclick="check_click('<?=$t?>')" type="checkbox" value="<?=$calc_flag?>" <? if ($calc_flag=="1") echo "checked='checked'"?> ></td>
								<td class="center"><a name="calc_des_<?=$t?>" disabled="disabled" class="link-gray-none" id="calc_des_<?=$t?>" style="width: 56px;" onclick="cal('0<?=$t?>','<?=$t?>');" href="#">계산내역</a></td>
								<td class="center"><input name="attend_cd_<?=$t?>" class="bluebox" id="attend_cd_<?=$t?>" style="width: 35px;" ondblclick="search_code('2', '<?=$t?>', 'double');" onchange="search_code('2', '<?=$t?>', '');" type="text" value="<?=$attend_cd?>"> <input name="attend_des_<?=$t?>" class="default" id="attend_des_<?=$t?>" style="width: 75px;" type="text" readonly="readonly" value="<?=$attend_des?>"><input name="attend_gubun<?=$t?>" id="attend_gubun<?=$t?>" type="hidden" value=""><input name="uid_<?=$t?>" id="uid_<?=$t?>" type="hidden" value="<?=$uid?>"></td>
							</tr>
						<?
							++$t;
								}?>
						<?}else{ ?>
						
						
						<? for ($i="1"; $i < "31"; $i++){?>
						<tr>
							<td>[<?=$i?>] <input name="a_des_<?=$i?>" class="bluebox" id="a_des_<?=$i?>" type="text" maxlength="20" value=""></td>
							<td class="center"><input name="a_sort_<?=$i?>" class="text-right" id="a_sort_<?=$i?>" style="width: 50px;" onkeypress="num_check();" type="text" maxlength="2" value="0"></td>
							<td class="text-center"><input name="a_bonus_<?=$i?>" class="checkbox" id="a_bonus_<?=$i?>" type="checkbox" value="1"></td>
							<td class="text-center"><input name="a_bonus1_<?=$i?>" class="checkbox" id="a_bonus1_<?=$i?>" type="checkbox" value="1"></td>
							<td>
								<select name="a_daily_<?=$i?>" class="center" id="a_daily_<?=$i?>" style="width:105px;" onchange="fnSetValue(this.value,'<?=$i?>');">
									<option selected="selected" value="0">고정</option>
									<option value="1">변동(일)</option>
									<option value="2">변동(시간)</option>
									<option value="3">변동(지급률)</option>
								</select>
							</td>
							<td class="center"><input name="a_rate_<?=$i?>" class="text-right" id="a_rate_<?=$i?>" style="width: 40px;" onkeyup="text_check('a_rate_<?=$i?>','5');" type="text" maxlength="5" value="0"></td>
							<td class="center"><input name="a_nontax_<?=$i?>" id="a_nontax_<?=$i?>" type="hidden" value="00"><input name="a_nontax_cd_<?=$i?>" class="bluebox" id="a_nontax_cd_<?=$i?>" style="width: 40px;" ondblclick="search_code('1', '<?=$i?>', 'double');" onchange="search_code('1', '<?=$i?>', '');" type="text" value="000"> <input name="a_nontax_des_<?=$i?>" class="default" id="a_nontax_des_<?=$i?>" style="width: 120px;" type="text" readonly="readonly" value="전액과세"></td>
							<td class="center">
								<select name="calc1_<?=$i?>" id="calc1_<?=$i?>" style="width: 80px;" >
									<option selected="selected" value="01">원</option>
									<option value="10">십원</option>
									<option value="21">소수점1</option>
									<option value="22">소수점2</option>
								</select>  
								<select name="calc2_<?=$i?>" id="calc2_<?=$i?>" style="width: 80px;">
									<option selected="selected" value="R">반올림</option>
									<option value="C">절상</option>
									<option value="F">절사</option>
								</select>
							</td>
							<td class="text-center"><input name="calc_flag_<?=$i?>" class="checkbox" id="calc_flag_<?=$i?>" onclick="check_click('<?=$i?>')" type="checkbox" value="1"></td>
							<td class="center"><a name="calc_des_<?=$i?>" disabled="disabled" class="link-gray-none" id="calc_des_<?=$i?>" style="width: 56px;" onclick="cal('0<?=$i?>','<?=$i?>');" href="#">계산내역</a></td>
							<td class="center"><input name="attend_cd_<?=$i?>" class="bluebox" id="attend_cd_<?=$i?>" style="width: 35px;" ondblclick="search_code('2', '<?=$i?>', 'double');" onchange="search_code('2', '<?=$i?>', '');" type="text" value=""> <input name="attend_des_<?=$i?>" class="default" id="attend_des_<?=$i?>" style="width: 75px;" type="text" readonly="readonly" value=""><input name="attend_gubun<?=$i?>" id="attend_gubun<?=$i?>" type="hidden" value=""></td>
						</tr>
						<?}?>
						<?}?>
                        <!-- <tr>
							<td>[20] <input name="a_des_20" class="bluebox" id="a_des_20" style="width:110px;" type="text" maxlength="20" value="상여"></td>
							<td class="center"><input name="a_sort_20" class="text-right" id="a_sort_20" style="width: 50px;" onkeypress="num_check();" type="text" maxlength="2" value="20"></td>
							<td class="center"><input name="a_bonus_20" id="a_bonus_20" type="hidden" value="0"></td>
							<td class="center"><input name="a_bonus1_20" id="a_bonus1_20" type="hidden" value="0"></td>
							<td class="center"><input name="a_daily_20" id="a_daily_20" type="hidden" value="0"></td>
							<td class="center"><input name="a_rate_20" id="a_rate_20" type="hidden" value="0"></td>
							<td class="center"><input name="a_rate_20" id="a_nontax_20" type="hidden" value="00"></td>
							<td class="center"><input name="calc1_20" id="calc1_20" type="hidden" value="01"><input name="calc2_20" id="calc2_20" type="hidden" value="R"></td>
							<td class="center"><input name="calc_flag_20" id="calc_flag_20" type="hidden" value="0"></td>
							<td class="center"><input name="calc_des20" id="calc_des20" type="hidden" value="계산내역"></td>
							<td class="center"></td>
						</tr> -->
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


<div id="dialog-message4" class="dialog-view hide">
		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->

					<div class="col-xs-12">
						<div class="col-xs-3" style="float:left">
							비과세검색
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
						<table id="non_taxable_code_list" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="col-xs-3 center" style="background-color:#f1f1f1">비과세코드</th>
									<th class="col-xs-8 center" style="background-color:#f1f1f1">비과세명</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
			</div>
		</div>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->



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
				

});
</script>
<!----------------------------------------------------------------------------------------------------------------------->
<script>

function postAccount(code,name,manager) {
	$("#dialog-message3").dialog("close");
	$("#account_cd").val(code);
	$("#account_nm").val(name);
}

function postNonTaxableCode(code,name,phase){
	$("#dialog-message4").dialog("close");
	$("#a_nontax_cd_" + phase).val(code);
	$("#a_nontax_des_" + phase).val(name);
	//}
}
 
function getNonTaxableCode(phase) {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var aci_cd = $("#aci_cd").val();

	$.getJSON("ajax/salary.php",{"page":page, "mode":"get_non_taxable_code", "rpp" : rpp, "adjacents" : adjacents, "where":search, "aci_cd":aci_cd},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td class='text-center'><a href='javascript:void(0);'  onclick=\"postNonTaxableCode('" + json[i].a_nontax_cd + "','" + json[i].a_nontax_nm + "','"+ phase +"')\">" + json[i].a_nontax_cd + "</a></td>";
					tag += "<td><a href='javascript:void(0);'  onclick=\"postNonTaxableCode('" + json[i].a_nontax_cd + "','" + json[i].a_nontax_nm + "','"+ phase +"')\">" + json[i].a_nontax_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#non_taxable_code_list tbody").html(tag);

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
					tag += "<td ><a href='javascript:void(0);'  onclick=\"postAccount('" + json[i].account_cd + "','" + json[i].account_nm + "')\">" + json[i].account_cd + "</a></td>";
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

 <script type="text/javascript">    
    <!--
        var objDHtml = null;  //모달창 전역 객체 선언

        //window.onload = function() {    
        //    $("#a_des_1").get(0).focus();
         //   $("#form1").attr("action", fnSetUrlPath("EPG003M_SAVE.aspx", "ec_req_sid"));
        //}

        function yy_reload() {        
            var yy_t = $("#yy_t option:selected").val();

            self.location = "index.php?controller=salary&action=registSalaryItme&yy_t=" + yy_t;            
        }

        function search_code(gubun, phase, key_type) {
            var Year = 2017;
            var Code;
            
            if (gubun == "1")
            {
                var dialog = $( "#dialog-message4" ).removeClass('hide').dialog({
				width : 500,
				height:500,
				modal: true,
				title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>비과세검색</h4></div>",
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

				getNonTaxableCode(phase)
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
            /*
			if ("W" == "R") {
                alert('읽기 권한자는 사용할 수 없는 기능입니다.\n\n마스터에게 문의 바랍니다.');
                return false;
            }
            else if ("W" == "U") {
                alert('수정 권한이 없습니다.');
                return false;
            }
			*/

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
                //var vChk = fnValidCheck(obj1.get(0), true);  //특수문자 ',  \, ", ∬,  Em대쉬 체크                   
                //    if (vChk == false) {obj1.focus();  return false; } 
            
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
			//alert('aaaaaa')
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


		function num_check() {   //;  
		if (navigator.userAgent.indexOf("MSIE") != -1) {
			var keyCode = window.event.keyCode;
			if (((keyCode < 48) || (keyCode > 57))) {
				event.returnValue = false;
				//alert("숫자를 입력하세요.");
			}
		}
		return;
		}

		function text_check(text, total, result) {
			var obj = $("#" + text);
			var len = obj.get(0).value.length;

			var count = 0;
			var one_ch = "";
			var total2 = 0;
			var result = result || '';
			for (i = 0; i < len; i++) {
				one_ch = obj.get(0).value.charAt(i); 
				if (escape(one_ch).length > 4) count += 2  
				else count++;
			}
			total2 = Math.floor(total / 2);
			if (count > total) {
				result = result.toString().replace(/num1/img, total2);
				result = result.toString().replace(/num2/img, total);
				if (result != '')
					alert(result);
				else
					alert(MSG01396);
				obj.get(0).value = obj.get(0).value.substr(0, total2);
				obj.focus();
				return false;
			}
		}

        //-->
    </script>    