<?require_once("assets/head_pop.php");?>
<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
				<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form id="ac_frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="accounting" />
						<input type="hidden" name="action" id="action" value="registCreditCardInsert" />
						
						<!-- 테이블 -->
						<table id="simple-table" class="table table-bordered table-hover">
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1" colspan=2><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 신용카드등록</th>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1" >카드구분</th>
								<td class="col-xs-10">
									<label>
										<input type="radio" class="ace" name="card_type" id="card_type" value="신용카드" checked />
										<span class="lbl"> 신용카드</span>
									</label>

									<label>
										<input type="radio" class="ace" name="card_type" id="card_type" value="체크카드" />
										<span class="lbl"> 체크카드</span>
									</label>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 카드번호</th>
								<td class="col-xs-10"><input type="text" name="card_num" id="card_num" /> <input type="button" id="confirmCardNum" value="중복확인" class="btn btn-inverse btn-sm"> <span id="id_signed"></span></td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 카드명</th>
								<td class="col-xs-10"><input type="text" class="form-control" name="card_name" id="card_name" /></td>
								</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 계정명</th>
								<td class="col-xs-10">
									<div class="input-group">
										<input type="hidden" class="form-control" name="aci_cd" id="aci_cd" readonly />
										<span class="input-group-addon btn-purple" id="id-btn-dialog1">
											<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
										</span>
										<input type="text" class="form-control" name="aci_nm" id="aci_nm" readonly />
										
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">카드관리자</th>
								<td class="col-xs-10"><input type="text" class="form-control" name="card_manager" id="card_manager" /></td>
								</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">검색창내용</th>
								<td class="col-xs-10"><input type="text" class="form-control" name="search_box" id="search_box" /></td>
							</tr>
							<tr>
								<th class="col-xs-2" style="background-color:#f1f1f1">적요</th>
								<td class="col-xs-10"><input type="text" class="form-control" name="re_mark" id="re_mark" /></td>
							</tr>
							
						</table>
					</form>
				</div>
			</div><!-- /.row -->
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<div class="col-xs-12">
						<button class="btn btn-info" type="button" id="btn-footer-Change" onclick="formSubmit()">
							<i class="ace-icon fa fa-check"></i>
							저장
						</button>
						<button class="btn btn-info" type="button" id="btn-footer-close" >
							<i class="ace-icon fa fa-check"></i>
							닫기
						</button>
					</div>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<input type="hidden" name="page" id="page" value="1" />
<input type="hidden" name="searchTxt" id="searchTxt" value="" />
<input type="hidden" name="where" id="where" value="" />
<!-- <input type="hidden" name="aci_cd" id="aci_cd" value="" /> -->

<div id="dialog-message1" class="dialog-view hide">
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
								<tbody></tbody>
							</table>
						</div>
					<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
				</div>
			</div>
	<div class="col-xs-12" style="text-align:center"><span id="paging_area"></span></div>
</div><!-- #dialog-message -->

<div id="dialog-message2" class="dialog-view hide">
	<table id="project_list" class="table  table-bordered">
		<thead>
			<tr>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">[계정코드] 계정명</th>
				<th class="col-xs-6 center" style="background-color:#f1f1f1">검색창내용</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
</div><!-- #dialog-message -->


<!----------------------------------------------------------------------------------------------------------------------->
<!--[if !IE]> -->
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/common.js"></script>
<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/jquery.inputlimiter.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<!-- page specific plugin scripts -->
<!----------------------------------------------------------------------------------------------------------------------->


		<!-- basic scripts -->
<script type="text/javascript">
<!--
	function formSubmit(){
	if(!check_str($("#card_num").val(),"카드명")) return false;
	if(!check_str($("#card_name").val(),"카드번호")) return false;
	//if(!check_str($("#aci_type").val(),"계정종류")) return false;
	$("#ac_frm").submit();
}
//-->
</script>


<!----------------------------------------------------------------------------------------------------------------------->
<?
//require_once ("assets/include_script.php");
?>
<!----------------------------------------------------------------------------------------------------------------------->

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getAccountCode();
	//createAccountCode();
});

function createAccountCode(){
	var data_string = "mode=createAccountCode";
	$.ajax({
		type : "post",
		url : "ajax/estimate.php",
		data : data_string,
		success : function(str) {
			$("#estimate_cd").val(str);
		}
	});
}

function createItemGroupCode(){
	var data_string = "mode=createItemGroupCode";

	$.ajax({
		type : "post",
		url : "ajax/ajax.php",
		data : data_string,
		success : function(str) {
			$("#sub_item_group_cd").val(str);
		}
	});	
}

// 계정코드 리스트 가져오기
function getAccountCode(){
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
					tag += "<td><a href='javascript:void(0);'  onclick=\"postAccountCode('" + json[i].aci_cd + "','" + json[i].aci_nm + "')\">[" + json[i].aci_cd + "] " + json[i].aci_nm + "</a></td>";
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

			getPaging(table,where,rpp,adjacents);
		}
	);
}


// 페이지 세트
function setPage(page){
	$("#page").val(page);
	getAccountCode(page);
}


// 거래처 구분으로 거래처 리스트 가져오기
function setAccountCode(val) {
	$("#page").val(1);
	$("#aci_cd").val(val);
	getAccountCode(1);
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
	//var search_choice = $("#search_choice option:selected").val();
	var txt = $("#search_txt").val();
	alert(txt)
	//if(search_choice == "account_nm") {
	//	$("#where").val(" where 1=1 and account_nm like '%" + txt + "%' ");
	//} else if(search_choice == "account_cd") {
		$("#where").val(" and (aci_cd like '%" + txt + "%' or aci_nm like '%" + txt + "%' )");
	//}
	getAccountCode(1);
}

function postAccountCode(code,name) {
	//if(manager != 'null') $("#manager").val(manager);
	//else $("#manager").val("");
	$("#dialog-message1").dialog("close");
	$("#aci_cd").val(code);
	$("#aci_nm").val(name); 
}

function postProject(code,name) {
	$("#project_cd").val(code);
	$("#project_nm").val(name);
}

</script>


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
				
	$( "#id-btn-dialog1" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>거래처 리스트</h4></div>",
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

				
	$( "#id-btn-dialog2" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>프로젝트 리스트</h4></div>",
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

	$( document).on('click',".id-btn-dialog", function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message3" ).removeClass('hide').dialog({
			width : 700,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>품목 리스트</h4></div>",
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
<script type="text/javascript">
	$(document).ready(function() {
		//아이디 중복 체크 실행 여부(0:중복체크X 1:중복체크O)
		var count = 0;
		
		$('#confirmCardNum').click(function() {
			var aci_cd = $('#aci_cd').val();
			if(aci_cd == ''){
				alert('카드번호를 입력하세요!');
				$('#aci_cd').focus();
				return;
			}
			
			//서버프로그램 연동해서 아이디 중복체크하기
			$.getJSON('ajax/account_code.php',{"mode":"confirmAccountCode", "aci_cd":aci_cd},function(json){
				if(json == 'success'){
						count = 0;
						$('#id_signed').html('이미 존재하는 코드 입니다.').css('color','red');
						$('#aci_cd').val('').focus();
				}else {
					count = 1;
					$('#id_signed').html('사용 가능한 계정코드 입니다').css('color','black');
				}
			});
		});
		
		//input태그에 key이벤트 연결
		$('#ac_frm #aci_cd').keyup(function(){
			count = 0;
			$('#id_signed').html('');
		});
		/*
		$('#ac_frm').submit(function(){
			if(count == 0){
				alert('계정코드 중복체크 필수');
				if($('#aci_cd').val() == '') {
					$('#aci_cd').focus();
				}else {
					$('#confirmCardNum').focus();
				}
				return false;
			}else {
				alert('전송');
			}
		});
		*/
	});
</script>

<script>
		function showKeyCode(event) {
			event = event || window.event;
			var keyID = (event.which) ? event.which : event.keyCode;
			if( ( keyID >=48 && keyID <= 57 ) || ( keyID >=96 && keyID <= 105 ) )
			{
				return;
			}
			else
			{
				return false;
			}
		}
</script>


