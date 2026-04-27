<?
$title = "공정리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");

session_start();
extract($_POST);
extract($_GET);

$sql = "select * from erp_process";
$result = mysql_query($sql) or die (mysql_error());

?>

<script>
function postProcess(process_cd, process_nm, ranking) {
	
	$(opener.document).find("#process_cd").val(process_cd);
	$(opener.document).find("#process_nm").val(process_nm);
	$(opener.document).find("#ranking").val(ranking);
	self.close();
}	


function centerOpenWindow(theURL, winName, width, height, fstate, scrollbars){ 
	var features = " width=" + width ; 
	features += ", height=" + height ; 
	var state = ""; 
	var scrollbars = "yes"; 
	var res_w = ( $(window).width() - width ) / 2; 
	var res_h = ( $(window).height() - height ) / 2; 
	if ( window.screenLeft >= window.screen.width ) { 
		res_w = window.screen.width + res_w; 
	} 
	if (fstate == "") { // 옵션 
		state = features + ", left=" + res_w + ", top=" + res_h + ", scrollbars=yes";
	} else { 
		state = fstate + ", " + features + ", left=" + res_w + ", top=" + res_h + ", scrollbars=yes";
	} 
	var win = window.open(theURL,winName,state); 
	win.focus(); 
} 


// 
function registProductProcess() {
	if($("#process_cd").val() == "") {
		alert("생산공정코드를 입력하세요");
		$("#process_cd").focus();
		return false;
	}

	if($("#process_nm").val() == "") {
		alert("생산공정명을 입력하세요");
		$("#process_nm").focus();
		return false;
	}

	if($("#ranking").val() == "") {
		alert("순위를 입력하세요");
		$("#ranking").focus();
		return false;
	}
	
	var data_string = "mode=registProcess&process_cd=" + $("#process_cd").val() + "&process_nm=" + $("#process_nm").val() + "&ranking=" + $("#ranking").val();
	$.ajax({
		type : "post",
		url : "../../ajax/base.php",
		data : data_string,
		success : function (str) {
			if($.trim(str) == "success") {
				alert("생산공정을 등록하였습니다");
			}else if($.trim(str) == "duplicate") {
				$('#chk').html('<b style="font-size:11px;color:red">이미 존재하는 생산코드입니다. 다른 생산코드를 입력하세요.</b>');
			} else {
				alert(str);
			}
		}
	});

	$("#dialog-message1").dialog( "close" ); 
	location.reload();
}

// 
function modifyProductProcess(uid) {
	if($("#process_cd").val() == "") {
		alert("생산공정코드를 입력하세요");
		$("#process_cd").focus();
		return false;
	}

	if($("#process_nm").val() == "") {
		alert("생산공정명을 입력하세요");
		$("#process_nm").focus();
		return false;
	}

	if($("#ranking").val() == "") {
		alert("순위를 입력하세요");
		$("#ranking").focus();
		return false;
	}
	
	var data_string = "mode=modifyProcess&process_gb=" + $("#process_gb").val() +"&process_cd=" + $("#process_cd").val() + "&process_nm=" + $("#process_nm").val() + "&ranking=" + $("#ranking").val()+ "&uid=" + uid;
	$.ajax({
		type : "post",
		url : "../../ajax/base.php",
		data : data_string,
		success : function (str) {
			if($.trim(str) == "success") {
				alert("생산공정을 수정하였습니다");
			}else if($.trim(str) == "duplicate") {
				$('#chk').html('<b style="font-size:11px;color:red">이미 존재하는 생산코드입니다. 다른 생산코드를 입력하세요.</b>');
			} else {
				alert(str);
			}
		}
	});

	$("#dialog-message1").dialog( "close" ); 
	location.reload();
}

function deleteProductProcess(uid) {
	var result = confirm('삭제하시겠습니까?'); 
	if(result) {
		var data_string = "mode=deleteSelectProcess&uid=" +uid;
		$.ajax({
			type : "post",
			url : "../../ajax/base.php",
			data : data_string,
			success : function (str) {
				if($.trim(str) == "success") {
					alert("생산공정이 삭제 되었습니다");
					location.reload();
				} else {
					alert(str);
				}
			}
		});
	}else {
	
	}

}
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" />
				<input type="hidden" name="controller" id="controller" value="groupware" />
				<input type="hidden" name="action" id="action" value="registEleSettlement" />
				<input type="hidden" name="mode" id="mode" />

				<!-- 테이블 -->
				<table id="simple-table" class="table  table-bordered table-hover">
					<tr>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">공정구분</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">공정코드</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">공정명</th>
						<th class="col-xs-3 center" style="background-color:#f1f1f1">순번</th>
					</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
			<?if($mode=='reg'){?>
					<tr>
						<td class='center'><a href="#" style="cursor:pointer" onclick="dialogOpens('<?=$t->uid?>','<?=$t->process_gb?>','<?=$t->process_cd?>','<?=$t->process_nm?>','<?=$t->ranking?>')"><?=$t->process_gb?></a></td>
						<td class='center'><a href="#" style="cursor:pointer" onclick="dialogOpens('<?=$t->uid?>','<?=$t->process_gb?>','<?=$t->process_cd?>','<?=$t->process_nm?>','<?=$t->ranking?>')"><?=$t->process_cd?></a></td>
						<td class='center'><a href="#" style="cursor:pointer" onclick="dialogOpens('<?=$t->uid?>','<?=$t->process_gb?>','<?=$t->process_cd?>','<?=$t->process_nm?>','<?=$t->ranking?>')"><?=$t->process_nm?></a></td>
						<td class='center'><a href="#" style="cursor:pointer" 
						onclick="dialogOpens('<?=$t->uid?>','<?=$t->process_gb?>','<?=$t->process_cd?>','<?=$t->process_nm?>','<?=$t->ranking?>')"><?=$t->ranking?></a></td>
					</tr>
			<?}else{?>
					<tr>
						<td class='center'><span style="cursor:pointer" onclick="postProcess('<?=$t->process_cd?>','<?=$t->process_nm?>','<?=$t->ranking?>')"><?=$t->process_gb?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postProcess('<?=$t->process_cd?>','<?=$t->process_nm?>','<?=$t->ranking?>')"><?=$t->process_cd?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postProcess('<?=$t->process_cd?>','<?=$t->process_nm?>','<?=$t->ranking?>')"><?=$t->process_nm?></span></td>
						<td class='center'><span style="cursor:pointer" onclick="postProcess('<?=$t->process_cd?>','<?=$t->process_nm?>','<?=$t->ranking?>')"><?=$t->ranking?></span></td>
					</tr>
			<?}?>		
<?
}				
?>
				</table>
			</form>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-info" type="button" id="id-btn-dialog2">
				<i class="ace-icon fa fa-check bigger-110"></i>
				신규
			</button>

			<button class="btn btn-xs " type="button" onclick="self.close()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				닫기
			</button>
		</div>
	</div><!-- // submit -->
</div><!-- /.page-content -->

<div id="dialog-message1" class="hide">
	<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="col-xs-2" style="background-color:#f1f1f1">공정구분</th>
					<td class="col-xs-6"><input type="text" class="form-control" name="process_gb" id="process_gb"  /></td>
				</tr>
				<tr>
					<th class="col-xs-2" style="background-color:#f1f1f1">생산공정코드</th>
					<td class="col-xs-6"><input type="text" class="form-control" name="process_cd" id="process_cd"  /><span id="chk"></span></td>
				</tr>
				<tr>
					<th class="col-xs-2" style="background-color:#f1f1f1">생산공정명</th>
					<td class="col-xs-6"><input type="text" class="form-control" name="process_nm" id="process_nm"  /></td>
				</tr>
				<tr>
					<th class="col-xs-2" style="background-color:#f1f1f1">순번</th>
					<td class="col-xs-6"><input type="text" class="form-control" name="ranking" id="ranking"  /></td>
				</tr>
			</table>
		</div>
	</div>
</div><!-- /.page-content -->
</div><!-- #dialog-message -->

<!--[if !IE]> -->
<script src="../../assets/js/jquery-2.1.4.min.js"></script>
<script src="../../assets/js/common.js"></script>
<!-- <![endif]-->

<!--[if IE]>
<script src="../../assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->


<!-- page specific plugin scripts -->
<script src="../../assets/js/jquery-ui.min.js"></script>
<script src="../../assets/js/jquery.ui.touch-punch.min.js"></script>
<!-- ace scripts -->
<script src="../../assets/js/ace-elements.min.js"></script>
<script src="../../assets/js/ace.min.js"></script>
<script src="../../assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="../../assets/js/jquery-ui.min.js"></script>

<script type="text/javascript">
jQuery(function($) {
		//override dialog's title function to allow for HTML titles
	$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
		_title: function(title) {
			var $title = this.options.title || '&nbsp;'
			if( ("title_html" in this.options) && this.options.title_html == true )
				title.html($title);
			else title.text($title);
		}
	}));
	//생산공정 신규 등록
	$( document).on('click',"#id-btn-dialog2", function(e) {
		e.preventDefault();
		//alert($(this).text())
			$("#process_gb").val('')
			$("#process_cd").val('')
			$("#process_nm").val('')
			$("#ranking").val('')
			$("#mode").val('insert')
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 550,
			height:350,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>생산공정 등록</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "저장",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						registProductProcess()
						//$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "닫기",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}

			]
		});
	});
});
	//생산공정 수정
	function dialogOpens(uid, p_gb, p_cd, p_nm, ranking) {
		event.preventDefault()
			$("#process_gb").val(p_gb)
			$("#process_cd").val(p_cd)
			$("#process_nm").val(p_nm)
			$("#ranking").val(ranking)
		var dialog = $( "#dialog-message1" ).removeClass('hide').dialog({
			width : 550,
			height:350,
			modal: true,
			title: "<div class='widget-header widget-header-small'><h4 class='smaller'><i class='ace-icon fa fa-minus-square'></i>생산공정 수정</h4></div>",
			title_html: true,
			buttons: [ 
				{
					text: "저장",
					"class" : "btn btn-primary btn-minier",
					click: function() {
						modifyProductProcess(uid)
						//$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "삭제",
					"class" : "btn btn-danger btn-minier",
					click: function() {
						deleteProductProcess(uid)
						$( this ).dialog( "close" ); 
					} 
				},
				{
					text: "닫기",
					"class" : "btn btn-minier",
					click: function() {
						$( this ).dialog( "close" ); 
					} 
				}

			]
		});
		
	}
</script>
<?
require_once("../../assets/pfoot.php");
?>