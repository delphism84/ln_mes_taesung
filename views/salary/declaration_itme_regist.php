<?	
	if ($yy_t == "") $yy_t = date('Y');
	$a_qry = " SELECT * from erp_declaration_itme where yy_t='".$yy_t."'";
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
					공제항목등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						공제항목등록
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->
	<div class="row">
		<div class="col-xs-12">	
		<form name="form1" id="form1" method="post" action="index.php">
		<input type="hidden" name="controller" id="controller" value="salary" />
		<?if($num_rows>"0"){?>
		<input type="hidden" name="action" id="action" value="registDeclarationItmeUpdate" />
		<?}else{?>
		<input type="hidden" name="action" id="action" value="registDeclarationItmeInsert" />
		<?}?>
		<input name="hidFavSeq" id="hidFavSeq" type="hidden">
			<div class="row">
				<div class="col-xs-12 text-center"><h3>공제항목등록</h3></div>
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
                <table id="statement_list" class="table  table-bordered table-hover">
                    <colgroup>
					<col width="19%">
					<col width="6%">
					<col width="16%">
					<col width="16%">
					<col width="18%">
					<col width="4%">
					<col width="7%">
					<col width="">
                    <thead>
                        <tr>
                            <th class="center">공제명칭</th>
                            <th class="center">표시순서</th>
                            <th class="center">계정코드<br></th>
                            <th class="center">거래처코드</th>                            
                            <th class="center">계산식</th>
                            <th class="center">계산항목</th>
                            <th class="center">계산내역</th>
                            <th class="center">비고</th>
                        </tr>
                    </thead>
                    <tbody>    
                        <?

							if($num_rows>0){
								$t="1";
							for($i=0; $arow=mysql_fetch_array($result); $i++) {
								$uid				=$arow["uid"];
								$d_des				=$arow["d_des"];
								$d_sort				=$arow["d_sort"];
								$aci_cd			=$arow["aci_cd"];
								$aci_nm			=$arow["aci_nm"];
								$cust				=$arow["cust"];
								$cust_name			=$arow["cust_name"];
								$calc1				=$arow["calc1"];
								$calc2				=$arow["calc2"];
								$calc_flag			=$arow["calc_flag"];
								$calc_des			=$arow["calc_des"];
								$etc				=$arow["etc"];
								$yy_t				=$arow["yy_t"];

								if ($d_sort ==""){
									$d_sort ="0";
								}
								if ($calc_flag ==""){
									$calc_flag ="0";
								}
							?>
							<tr>
								<td>[<?=$i?>] <input name="d_des_<?=$i?>" class="default" id="d_des_<?=$i?>" style="width: 120px;" type="text" maxlength="30" value="<?=$d_des?>" onfocus="this.select();"></td>
								<td><input name="d_sort_<?=$i?>" class="text-right" id="d_sort_<?=$i?>" style="width: 36px;" onkeypress="num_check();" onfocus="this.select();" type="text" maxlength="2" value="<?=$d_sort?>"></td>
								<td class="center"><input name="aci_cd_<?=$i?>" class="bluebox" id="aci_cd_<?=$i?>" style="width: 28%;" onfocus="this.select();" onkeyup="text_check('aci_cd_<?=$i?>','20');" ondblclick="search_code('<?=$i?>', 'double');" onchange="search_code('<?=$i?>', '');" type="text" value="<?=$aci_cd?>"> <input name="aci_nm_<?=$i?>" class="default" id="aci_nm_<?=$i?>" style="width: 60%;" type="text" readonly="readonly" value="<?=$aci_nm?>"></td>
								<td class="center"><input name="cust_<?=$i?>" class="bluebox" id="cust_<?=$i?>" style="width: 28%;" onfocus="this.select();" onkeyup="text_check('cust_<?=$i?>','40');" ondblclick="search_code('<?=$i?>', 'double', 'cust');" onchange="search_code('<?=$i?>', '', 'cust');" type="text" value="<?=$cust?>"> <input name="cust_name_<?=$i?>" class="default" id="cust_name_<?=$i?>" style="width: 60%;" type="text" readonly="readonly" value="<?=$cust_name?>"></td>
								<td class="center">
									<select name="calc1_<?=$i?>" id="calc1_<?=$i?>">
										<option value="01" <? if ($calc1=="01") echo "selected"?>>원</option>
										<option value="10" <? if ($calc1=="10") echo "selected"?>>십원</option>
										<option value="21" <? if ($calc1=="21") echo "selected"?>>소수점1</option>
										<option value="22" <? if ($calc1=="22") echo "selected"?>>소수점2</option>
									</select>
									<select name="calc2_<?=$i?>" id="calc2_<?=$i?>">
										<option value="R" <? if ($calc2=="R") echo "selected"?>>반올림</option>
										<option value="C" <? if ($calc2=="C") echo "selected"?>>절상</option>
										<option value="F" <? if ($calc2=="F") echo "selected"?>>절사</option>
									</select>
								</td>
								<!-- <td class="center"><input name="calc_flag_<?=$i?>" id="calc_flag_<?=$i?>" type="hidden" value="0"></td> -->
								<td class="center" align="center"><input name="calc_flag_<?=$i?>" class="checkbox" id="calc_flag_<?=$i?>" onclick="check_click2(this.checked,<?=$i?>,'2');" type="checkbox" value="1"></td>
								<!-- <td><input name="calc_des_<?=$i?>" id="calc_des_<?=$i?>" type="hidden"></td> -->
								<td class="center" ><a name="calc_des_<?=$i?>" class="link-gray-none" id="calc_des_<?=$i?>" style="width: 56px;" onclick="cal('<?=$i?>','<?=$i?>');" href="#">계산내역</a></td>
								<td><input name="etc_<?=$i?>" id="etc_<?=$i?>" type="text" value=""><input name="uid_<?=$i?>" id="uid_<?=$i?>" type="hidden" value="<?=$uid?>"></td>
							</tr>
							<?
							++$t;
							}?>
						<?}else{ ?>
						
						
						<? for ($i="0"; $i < "23"; $i++){
						if ($i < "9"){
							$calval = "0".($i+1);
						}else{
							$calval = 	($i+1);
						}
						?>
							<tr>
								<td>[<?=$calval?>] <input name="d_des_<?=$i?>" class="default" id="d_des_<?=$i?>" style="width: 120px;" type="text" maxlength="30" value="소득세" onfocus="this.select();"></td>
								<td><input name="d_sort_<?=$i?>" class="text-right" id="d_sort_<?=$i?>" style="width: 36px;" onkeypress="num_check();" onfocus="this.select();" type="text" maxlength="2" value="0"></td>
								<td class="center"><input name="aci_cd_<?=$i?>" class="bluebox" id="aci_cd_<?=$i?>" style="width: 28%;" onfocus="this.select();" onkeyup="text_check('aci_cd_<?=$i?>','20');" ondblclick="search_code('<?=$i?>', 'double');" onchange="search_code('<?=$i?>', '');" type="text" value="2549"> <input name="aci_nm_<?=$i?>" class="default" id="aci_nm_<?=$i?>" style="width: 60%;" type="text" readonly="readonly" value="예수금"></td>
								<td class="center"><input name="cust_<?=$i?>" class="bluebox" id="cust_<?=$i?>" style="width: 28%;" onfocus="this.select();" onkeyup="text_check('cust_<?=$i?>','40');" ondblclick="search_code('<?=$i?>', 'double', 'cust');" onchange="search_code('<?=$i?>', '', 'cust');" type="text" value=""> <input name="cust_name_<?=$i?>" class="default" id="cust_name_<?=$i?>" style="width: 60%;" type="text" readonly="readonly" value=""></td>
								<td class="center">
									<select name="calc1_<?=$i?>" id="calc1_<?=$i?>">
										<option value="01" <? if ($calc1=="01") echo "selected"?>>원</option>
										<option value="10" <? if ($calc1=="10") echo "selected"?>>십원</option>
										<option value="21" <? if ($calc1=="21") echo "selected"?>>소수점1</option>
										<option value="22" <? if ($calc1=="22") echo "selected"?>>소수점2</option>
									</select>
									<select name="calc2_<?=$i?>" id="calc2_<?=$i?>">
										<option value="R" <? if ($calc2=="R") echo "selected"?>>반올림</option>
										<option value="C" <? if ($calc2=="C") echo "selected"?>>절상</option>
										<option value="F" <? if ($calc2=="F") echo "selected"?>>절사</option>
									</select>
								</td>
								<!-- <td class="center"><input name="calc_flag_<?=$i?>" id="calc_flag_<?=$i?>" type="hidden" value="0"></td> -->
								<td class="center" align="center"><input name="calc_flag_<?=$i?>" class="checkbox" id="calc_flag_<?=$i?>" onclick="check_click2(this.checked,<?=$i?>,'2');" type="checkbox" value="1"></td>
								<!-- <td><input name="calc_des_<?=$i?>" id="calc_des_<?=$i?>" type="hidden"></td> -->
								<td class="center" ><a name="calc_des_<?=$i?>" class="link-gray-none" id="calc_des_<?=$i?>" style="width: 56px;" onclick="cal('<?=$calval?>','<?=$i?>');" href="#">계산내역</a></td>
								<td><input name="etc_<?=$i?>" id="etc_<?=$i?>" type="text" value=""></td>
							</tr>
						<?}?>
						<?}?>
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


});
</script>
<!----------------------------------------------------------------------------------------------------------------------->
<script>

function postAccount(code,name,manager) {
	$("#dialog-message3").dialog("close");
	$("#account_cd").val(code);
	$("#account_nm").val(name);
}

function postAccountCode(code,name,phase){
	$("#dialog-message4").dialog("close");
	//$("#aci_cd").val(code);
	//$("#aci_nm").val(name);
	$("#aci_cd_" + phase).val(code);
	$("#aci_nm_" + phase).val(name);
	//}
}

function getAccountCode(phase) {
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
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccountCode('" + json[i].aci_cd + "','" + json[i].aci_nm + "','"+ phase +"')\">[" + json[i].aci_cd + "] " + json[i].aci_nm + "</a></td>";
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

        window.onload = function() {

            $("#d_des_0").get(0).focus();   
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
            var yy_t = $("#yy_t option:selected").val();
            self.location = "index.php?controller=salary&action=registDeclarationItme&yy_t=" + yy_t;            
        }

			function search_code(phase, key_type, flag)
			{
			
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

			getAccountCode(phase)
				/*
				objName = $("#aci_nm_" + phase);
				strName = objName.val();
				objCode = $("#aci_cd_" + phase);
				strCode = objCode.val();
				objNextBox = $("#d_sort_" + phase);

				Code = objCode.get(0).value;
				objCode.get(0).value = "";
				objName.get(0).value = "";
				*/
			//var url = "index.php?controller=accounting&action=listPageAccountingCodePop&pop=Y&dialogid=id-btn-dialog2";
			//$("#generalStatement_modify_frame").attr("src", url);
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
            var row = 23;
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
                //var vChk = fnValidCheck(obj1.get(0), true);  //특수문자 ',  \, ", ∬,  Em대쉬 체크                   
                //    if (vChk == false) {obj1.focus();  return false; } 
            
			    if (obj0.get(0).value > row) 
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