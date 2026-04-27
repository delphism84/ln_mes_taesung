<?
$sql = "select * from erp_item where uid=".$_GET['uid'];
$t = fetch_object($sql);
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
					<a href="#">생산관리</a>
				</li>
				<li class="active">BOM 등록</li>
			</ul><!-- /.breadcrumb -->
		</div>

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					BOM 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						BOM 정보를 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form id="frm" method="post" action="index.php">
						<input type="hidden" name="controller" id="controller" value="production" />
						<input type="hidden" name="action" id="action" value="registBom" />
						<input type="hidden" name="uid" id="uid" value="<?=$_GET['uid']?>" />
						<div>
							<!-- 테이블 -->
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">상위품목</th>
									<td class="col-xs-1"><span id="item_nm"><?=$t->item_nm?></span></td>
									<th class="col-xs-1" style="background-color:#f1f1f1">규격</th>
									<td class="col-xs-1"><span id="standard1"><?=$t->standard1?></span></td>
									<th class="col-xs-1" style="background-color:#f1f1f1">재질</th>
									<td class="col-xs-1"><span id="material"><?=$t->material?></span></td>
									<th class="col-xs-1" style="background-color:#f1f1f1">단위</th>
									<td class="col-xs-1"><span id="unit"><?=$t->unit?></span></td>
									<th class="col-xs-1" style="background-color:#f1f1f1">생산공정</th>
									<td class="col-xs-1"><span id="standard"><?=$t->standard3?></span></td>
									<th class="col-xs-1" style="background-color:#f1f1f1"><i class="cf fa fa-check" aria-hidden="true"></i> 생산수량</th>
									<td class="col-xs-1"><input type="text" class="form-control" name="process_cd" id="process_cd" value="1" /></td>
								</tr>
							</table>
						</div>

						<div>
							<a class="btn btn-xs btn-success" onclick="centerOpenWindow('views/popup/addBom.php', '품목리스트', 1000, 650)">품목선택</a>
							<table id="bom" class="table  table-bordered table-hover" style="margin-top:10px">
								<thead>
									<tr>
										<th class="detail-col center" style="background-color:#f1f1f1"></th>
										<th class="col-xs-2" style="background-color:#f1f1f1">품목코드</th>
										<th class="col-xs-2" style="background-color:#f1f1f1">품목명</th>
										<th class="col-xs-2" style="background-color:#f1f1f1">규격</th>
										<th class="col-xs-2" style="background-color:#f1f1f1">재질</th>
										<th class="col-xs-2" style="background-color:#f1f1f1">단위</th>
										<th class="col-xs-2" style="background-color:#f1f1f1">소요수량</th>
										<!-- <th class="col-xs-2" style="background-color:#f1f1f1">LOT-NO</th> -->
										
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
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
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=production&action=listPageBom' ">
						<i class="ace-icon fa fa-undo bigger-110"></i>
						목록 돌아가기
					</button>
				</div>
			</div><!-- // submit -->
		</div><!-- /.page-content -->
	</div>
</div><!-- /.main-content -->


<input type="hidden" name="flag" id="flag" value="1" />

<?
require_once ("assets/include_script.php");
?>

<!-- Table Tr Add ------------------------------------------------------------------------------------------------------->
<script>
$(document).ready(function(){
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	getBom();
});

function centerOpenWindow(theURL, winName, width, height, fstate, scrollbars){ 
	var features = "width=" + width ; 
	features += ",height=" + height ; 
	var state = ""; 
	var scrollbars = "yes";
	var res_w = ( $(window).width() - width ) / 2; 
	var res_h = ( $(window).height() - height ) / 2; 
	if ( window.screenLeft >= window.screen.width ) { 
		res_w = window.screen.width + res_w; 
	} 
	if (fstate == "") { // 옵션 
		state = features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ",top=" + res_h + ",scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 

function getItemName() {
	var dataString = "mode=getItemName&uid=" + $("#uid").val();
	$.ajax({
		type : "post",
		url : "ajax/production.php",
		data : dataString,
		success : function(str) {
			$("#item_nm").html(str);
		}
	});
}

function getItemStandard() {
	var dataString = "mode=getItemStandard&uid=" + $("#uid").val();
	$.ajax({
		type : "post",
		url : "ajax/production.php",
		data : dataString,
		success : function(str) {
			$("#standard").html(str);
		}
	});
}

function delTr(flag){
	var tr = $(flag).parent().parent();
	tr.remove();

	var currentFlag = $("#flag").val();
	var nextFlag = Number(currentFlag) - 1;
	if(nextFlag < 4) {} else $("#flag").val(nextFlag);
}

function itemFlag(flag) {
	$("#itemFlag").val(flag);
}

function getBom(){
	var uid = $("#uid").val();
	var tag = "";
	
	var cnt_total = "" ;

	$.getJSON("ajax/production.php",{"mode":"getBom", "uid" : uid},
		function(json){
			if(json != null) {
				var k = 1;
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr class='item" + k + "'>";					
					tag += "<td class='center'><i class='delBtn fa fa-minus-square fa-2x' aria-hidden='true' onclick='delTr(this)'></i></td>";
					tag += "<td><input type='text' class='form-control id-btn-dialog item_cd' name='item_cd[]' id='item_cd_" + k + "' value='" + json[i].item_cd + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' id='item_nm_" + k + "' name='item_nm[]' value='" + json[i].item_nm + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' id='standard1_" + k + "' name='standard1[]' value='" + json[i].standard1 + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' id='material_" + k + "' name='material[]' value='" + json[i].material + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' id='unit_" + k + "' name='unit[]' value='" + json[i].unit + "' readonly /></td>";
					tag += "<td><input type='text' class='form-control' id='cnt_" + k + "' name='cnt[]' value='" + $("#process_cd").val() * json[i].cnt + "' /></td>";
					//tag += "<td><input type='text' class='form-control' id='lot_no_" + k + "' name='lot_no[]' value='' /></td>";
					tag += "</tr>";
					$("#flag").val(k);
					
					k++;
				}
				$("#bom tbody").append(tag);
			}
			
		}
	);
}

function formSubmit() {
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
	
	
	// 품목 팝업
	$( document).on('click',".id-btn-dialog" , function(e) {
		e.preventDefault();
			
		var dialog = $( "#dialog-message" ).removeClass('hide').dialog({
			width : 500,
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

	
	//datepicker plugin
	//link
	$('.date-picker').datepicker({
		autoclose: true,
		todayHighlight: true,
			language: "kr"
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