

<div class="main-content">
	<div class="main-content-inner">
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>

				<li>
					<a href="#">영업관리</a>
				</li>
				<li class="active">AS 등록</li>
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
					AS 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						접수된 AS정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="sales" />
						<input type="hidden" name="action" id="action" value="updateAs" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />
						<!-- 테이블 -->
						<a class="btn btn-xs btn-inverse" onclick="addTr()">접수정보</a>
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">접수일자</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="accept_dt" id="accept_dt" type="text" data-date-format="yyyy-mm-dd" value="<?=$t->accept_dt?>" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">진행상태</th>
								<td class="col-xs-5">
									<select name="state" id="state">
										<option value="접수" <? if($t->state == "접수") echo "selected"; ?>>접수</option>
										<option value="처리중" <? if($t->state == "처리중") echo "selected"; ?>>처리중</option>
										<option value="처리완료" <? if($t->state == "처리완료") echo "selected"; ?>>처리완료</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">거래처명</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="account_cd" id="account_cd" value="<?=$t->account_cd?>" />
												<input type="text" name="account_nm" id="account_nm" value="<?=$t->account_nm?>" />
												<span class="input-group-addon btn-purple" id="id-btn-dialog1">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">담당자</th>
								<td class="col-xs-5">
									<input type="text" name="account_manager" id="account_manager" value="<?=$t->account_manager?>"/>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">이메일</th>
								<td class="col-xs-5"><input type="text" name="email" id="email" value="<?=$t->email?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">연락처</th>
								<td class="col-xs-5"><input type="text" name="phone" id="phone" value="<?=$t->phone?>" /></td>
							</tr>
						</table>
						
						<a class="btn btn-xs btn-inverse" onclick="addTr()">AS정보</a>
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">품목</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="text" name="item_cd" id="item_cd" value="<?=$t->item_cd?>" />
												<input type="text" name="item_nm" id="item_nm" value="<?=$t->item_nm?>" />
												<span class="input-group-addon btn-purple" id="id-btn-dialog2">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">불량구분</th>
								<td class="col-xs-5">
									<select name="faulty" id="faulty">
										<option value="파손" <? if($t->faulty == "파손") echo "selected"; ?>>파손</option>
										<option value="분실" <? if($t->faulty == "분실") echo "selected"; ?>>분실</option>
										<option value="에러" <? if($t->faulty == "에러") echo "selected"; ?>>에러</option>
										<option value="하자" <? if($t->faulty == "하자") echo "selected"; ?>>하자</option>
										<option value="변심" <? if($t->faulty == "변심") echo "selected"; ?>>변심</option>
										<option value="기타" <? if($t->faulty == "기타") echo "selected"; ?>>기타</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">상세내용</th>
								<td class="col-xs-5">
									<textarea class="form-control" rows="5" name="memo" id="memo"><?=$t->memo?></textarea>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">처리결과</th>
								<td class="col-xs-5">
									<textarea class="form-control" rows="5" name="as_result" id="as_result"><?=$t->as_result?></textarea>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">처리방법</th>
								<td class="col-xs-5">
									<select name="processing" id="processing">
										<option value="재설치" <? if($t->processing == "재설치") echo "selected"; ?>>재설치</option>
										<option value="교환" <? if($t->processing == "교환") echo "selected"; ?>>교환</option>
										<option value="방문처리" <? if($t->processing == "방문처리") echo "selected"; ?>>방문처리</option>
										<option value="전화" <? if($t->processing == "전화") echo "selected"; ?>>전화</option>
										<option value="원격" <? if($t->processing == "원격") echo "selected"; ?>>원격</option>
										<option value="기타" <? if($t->processing == "기타") echo "selected"; ?>>기타</option>
									</select>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">처리비용</th>
								<td class="col-xs-5">
									<input type="text" name="processing_cost" id="processing_cost" class='onlynum' value="<?=$t->processing_cost?>"/>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">처리담당자</th>
								<td colspan="3" class="col-xs-11">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="emp_id" id="emp_id" value="<?=$t->emp_id?>" />
												<input type="text" name="emp_nm" id="emp_nm" value="<?=$t->emp_nm?>" />
												<span class="input-group-addon btn-purple" id="id-btn-dialog3">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"></i> 첨부</th>
								<td colspan="3" class="col-xs-11"><input type="file" name="attach" id="attach" />
								<?
								if (!empty($t->attach)) {
									$filename = explode('|',$t->attach);
									$change_filename = explode('|',$filename);
									$filesize = explode('|',$filesize);
									
									for($i = 0; $i < count($filename); $i++) {
										echo "<a href='/assets/download.php?module=file&downtype=&realname=".urlencode($filename[$i])."&downfile=".urlencode($filename[$i])."&mem_sn=".$mem_sn."'>{$filename[$i]} {$filesize[$i]}</a><br>";
									}						
								}		
								?>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div><!-- /.row -->

			
			
			<!-- submit -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn btn-info" type="button" onclick="formSubmit()">
						<i class="ace-icon fa fa-check bigger-110"></i>
						등록
					</button>
					&nbsp; &nbsp; &nbsp;
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=sales&action=listPageAs'">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->

<?
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();

	getAccount();
	getItem();
	getEmployee();

	$("#checkedAll").click(function(){
		if($("#checkedAll").prop('checked')) {
			$(".chk").each(function(){
				$(this).prop("checked",true);
			});
		} else {
			$(".chk").each(function(){
				$(this).prop("checked",false);
			});
		}
	});
});

function commaSplit(n) {// 콤마 나누는 부분
	var txtNumber = '' + n;
	var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
	var arrNumber = txtNumber.split('.');
	arrNumber[0] += '.';
	do {
		arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
	}
	while (rxSplit.test(arrNumber[0]));
	if(arrNumber.length > 1) {
		return arrNumber.join('');
	} else {
		return arrNumber[0].split('.')[0];
	}
}

function removeComma(n) {  // 콤마제거
	if ( typeof n == "undefined" || n == null || n == "" ) {
		return "";
	}
	var txtNumber = '' + n;
	return txtNumber.replace(/(,)/g, "");
}

function getItem() {
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;

	$.getJSON("ajax/item.php",{"page":page, "mode":"getItem", "rpp" : rpp, "adjacents" : adjacents},//, "search_choice" : search_choice, "txt" : txt},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					switch(json[i].item_gb) {
						case "product" : var item_gb = "완제품"; break;
						case "semi_product" : var item_gb = "반제품"; break;
						case "component" : var item_gb = "자재"; break;
					}
					tag += "<tr>";
					tag += "<td>" + item_gb + "</td>";
					tag += "<td><a href='#' onclick=\"postItem('" + json[i].item_cd + "','" + json[i].item_nm + "')\">" + json[i].item_cd + "</a></td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard + "</td>";
					tag += "</tr>";
				}
			}

			$("#item_list tbody").html(tag);

			var table = "erp_item";
			var where = "";

			getPaging(table,where,rpp,adjacents);
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
					tag += "<td><a href='#' onclick=\"postAccount('" + json[i].account_cd + "','" + json[i].account_nm + "','" + json[i].manager + "')\">" + json[i].account_cd + "</a></td>";
					tag += "<td>" + json[i].account_nm + "</td>";
					tag += "</tr>";
				}
			}

			$("#account_list tbody").html(tag);

			var table = "erp_account";
			if(account_gb == "" || account_gb == "all") {
				var where = $("#where").val();
			} else {
				var where = $("#where").val() + " and account_gb='"  + account_gb + "'";
			}

			getPaging(table,where,rpp,adjacents);
		}
	);
}


function getEmployee() {
	var tag = "";
	var department_cd = $("#department option:selected").val();
	$.getJSON("ajax/employee.php",{"mode":"getEmployee","department_cd":department_cd},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td>" + json[i].department_nm + "</td>";
					tag += "<td><a href='#' onclick=\"postEmp('" + json[i].emp_nm + "', '" + json[i].emp_id + "')\">" + json[i].emp_nm + "</a></td>";
					tag += "</tr>";
				}
			}

			$("#emp_list tbody").html(tag);
		}
	);
}

function postEmp(emp_nm,emp_id) {
	$("#emp_nm").val(emp_nm);
	$("#emp_id").val(emp_id);
}

function postItem(item_cd,item_nm){
	$("#item_cd").val(item_cd);
	$("#item_nm").val(item_nm);
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

function postAccount(code,name,manager) {
	if(manager != 'null') $("#manager").val(manager);
	else $("#manager").val("");
	$("#account_cd").val(code);
	$("#account_nm").val(name);
}

function formSubmit(){
	if(!check_str($("#account_cd").val(),"거래처")) return false;
	//if(!check_str($("#email").val(),"이메일")) return false;
	if(!check_str($("#phone").val(),"연락처")) return false;
	if(!check_str($("#item_cd").val(),"품목")) return false;
	if(!check_str($("#emp_id").val(),"처리담당자")) return false;
	$("#frm").submit();
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
	
	// 견적서 팝업
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


	// 품목 팝업
	$( "#id-btn-dialog2" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message2" ).removeClass('hide').dialog({
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

	// 프로젝트 팝업			
	$( "#id-btn-dialog3" ).on('click', function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message3" ).removeClass('hide').dialog({
			width : 500,
			height:500,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-check'></i>사원 리스트</h4></div>",
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