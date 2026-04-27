<div class="main-content">
	<div class="main-content-inner">
		<!-- 페이지 상단 Location -->
		<div class="breadcrumbs ace-save-state" id="breadcrumbs">
			<ul class="breadcrumb">
				<li>
					<i class="ace-icon fa fa-home home-icon"></i>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">기준정보관리</a>
				</li>
				<li class="active">부서 관리</li>
			</ul>
		</div>
		<!-- // 페이지 상단 Location -->

		<div class="page-content">
			<!-- 서브제목과 라인 -->
			<div class="page-header">
				<h1>
					부서 관리
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						등록된 부서 리스트를 보여드립니다.
					</small>
				</h1>
			</div>
			<!--// 서브제목과 라인 -->
			<div class="row">
				<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					<div>
						<div class="row">
							<div class="col-md-4 col-sm-8 col-xs-8">
								<button type="button" class="btn btn-success btn-sm" onclick="demo_create();"><i class="glyphicon glyphicon-asterisk"></i> Create</button>
								<button type="button" class="btn btn-warning btn-sm" onclick="demo_rename();"><i class="glyphicon glyphicon-pencil"></i> Rename</button>
								<button type="button" class="btn btn-danger btn-sm" onclick="demo_delete();"><i class="glyphicon glyphicon-remove"></i> Delete</button>
							</div>
							<div class="col-md-2 col-sm-4 col-xs-4" style="text-align:right;">
								<input type="text" value="" style="box-shadow:inset 0 0 4px #eee; width:120px; margin:0; padding:6px 12px; border-radius:4px; border:1px solid silver; font-size:1.1em;" id="demo_q" placeholder="Search" />
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div id="tree-container" style="margin-top:1em; min-height:200px;"></div>
							</div>
						</div>
						<div style="clear:both"></div>
<!-- // PAGE CONTENT BEGINS ---------------------------------------------------------------------------------------------------------------------------------------->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?
require_once ("assets/include_script.php");
?>

<script>
	function demo_create() {
		var ref = $('#tree-container').jstree(true),
			sel = ref.get_selected();
		if(!sel.length) { return false; }
		sel = sel[0];
		sel = ref.create_node(sel, {"type":"file"});
		if(sel) {
			ref.edit(sel);
		}
	};
	function demo_rename() {
		var ref = $('#tree-container').jstree(true),
			sel = ref.get_selected();
		if(!sel.length) { return false; }
		sel = sel[0];
		ref.edit(sel);
	};
	function demo_delete() {
		var ref = $('#tree-container').jstree(true),
			sel = ref.get_selected();
		if(!sel.length) { return false; }
		ref.delete_node(sel);
	};
	$(function () {
		var to = false;
		$('#demo_q').keyup(function () {
			if(to) { clearTimeout(to); }
			to = setTimeout(function () {
				var v = $('#demo_q').val();
				$('#tree-container').jstree(true).search(v);
			}, 250);
		});
		
		$(window).resize(function () {
			var h = Math.max($(window).height() - 0, 420);
			$('#container, #data, #tree-container, #data .content').height(h).filter('.default').css('lineHeight', h + 'px');
		}).resize();

			$('#tree-container').jstree({
				'core' : {
					"animation" : 0,
					"check_callback" : true,
					'force_text' : true,
					"themes" : { "stripes" : true },
			  'data' : {
					  'url' : '/views/base/response.php?operation=get_node',
					  'data' : function (node) {
						return { 'id' : node.id };
					  },
					  "dataType" : "json"
					}
					,'check_callback' : true,
					'themes' : {
					  'responsive' : false
					}
			  },
				 "types" : {
					"#" : { "max_children" : 1, "max_depth" : 4, "valid_children" : ["root"] },
					"root" : { "icon" : "/assets/images/tree_icon.png", "valid_children" : ["default"] },
					"default" : { "valid_children" : ["default","file"] },
					"file" : { "icon" : "glyphicon glyphicon-file", "valid_children" : [] }
				},
			  'plugins' : ['state','contextmenu','wholerow','dnd']
			}).on('create_node.jstree', function (e, data) {
					  alert(data.node.parent)
				  $.get('/views/base/response.php?operation=create_node', { 'id' : data.node.parent, 'position' : data.position, 'text' : data.node.text })
					.done(function (d) {
					  data.instance.set_id(data.node, d.id);
					})
					.fail(function () {
					  data.instance.refresh();
					});
				}).on('rename_node.jstree', function (e, data) {
				  $.get('/views/base/response.php?operation=rename_node', { 'id' : data.node.id, 'text' : data.text })
					.fail(function () {
					  data.instance.refresh();
					});
				}).on('delete_node.jstree', function (e, data) {
				  $.get('/views/base/response.php?operation=delete_node', { 'id' : data.node.id })
					.fail(function () {
					  data.instance.refresh();
					});
				});
	});
	</script>
<script>
$(document).ready(function(){
	// 특수문자 입력 방지
	$("input").keyup(function(){$(this).val( $(this).val().replace( /[ \{\}\[\]\/?.,;:|\)~`!^\┼<>@\#$%&\'\"\\\(\=]/gi,"") );} );
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );
	getBigDepartment();
});


// 거래처 리스트 가져오기
function getBigDepartment(){
	var tag = "";

	$.getJSON("ajax/base.php",{"mode":"getBigDepartment"},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postBigDepartment(" + json[i].uid + ",'" + json[i].department_nm + "'," + json[i].seq + ")\">" + json[i].department_nm + "</a></td>";
					tag += "<td>" + json[i].seq + "</td>";
					tag += "</tr>";
				}
			}

			$("#department_big_list tbody").html(tag);
		}
	);
}

function getMiddleDepartment(){
	var fid = $("#big_uid").val();
	var tag = "";

	$.getJSON("ajax/base.php",{"mode":"getMiddleDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postMiddleDepartment(" + json[i].uid + ",'" + json[i].department_nm + "'," + json[i].seq + ")\">" + json[i].department_nm + "</a></td>";
					tag += "<td>" + json[i].seq + "</td>";
					tag += "</tr>";
				}
			}

			$("#department_middle_list tbody").html(tag);
		}
	);
}

function getSmallDepartment(){
	var fid = $("#middle_uid").val();
	var tag = "";

	$.getJSON("ajax/base.php",{"mode":"getSmallDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<tr>";
					tag += "<td><a href='#' onclick=\"postSmallDepartment(" + json[i].uid + ",'" + json[i].department_nm + "'," + json[i].seq + ")\">" + json[i].department_nm + "</a></td>";
					tag += "<td>" + json[i].seq + "</td>";
					tag += "</tr>";
				}
			}

			$("#department_small_list tbody").html(tag);
		}
	);
}

function postBigDepartment(uid,name,seq){
	$("#big_uid").val(uid);
	$("#big_seq").val(seq);
	$("#big_department_nm").val(name);
	getMiddleDepartment();
	$("#department_small_list tbody").html("");
}

function postMiddleDepartment(uid,name,seq){
	$("#middle_uid").val(uid);
	$("#middle_seq").val(seq);
	$("#middle_department_nm").val(name);
	getSmallDepartment();
}

function postSmallDepartment(uid,name,seq){
	$("#small_uid").val(uid);
	$("#small_seq").val(seq);
	$("#small_department_nm").val(name);
}

function registBigDepartment() {
	if(!check_str($("#big_department_nm").val(),"부서명")) return false;
	if(!check_str($("#big_seq").val(),"출력순서")) return false;

	var uid = $("#big_uid").val();
	var department_nm = $("#big_department_nm").val();
	var seq = $("#big_seq").val();
	var dataString = "mode=registBigDepartment&department_nm=" + department_nm + "&seq=" + seq + "&uid=" + uid;

	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") getBigDepartment();
			$("#big_department_nm").val("");
			$("#big_seq").val("");
			$("#big_uid").val("");
		}
	});
}

function registMiddleDepartment() {
	if(!check_str($("#middle_department_nm").val(),"부서명")) return false;
	if(!check_str($("#middle_seq").val(),"출력순서")) return false;

	var uid = $("#middle_uid").val();
	var fid = $("#big_uid").val();
	var department_nm = $("#middle_department_nm").val();
	var seq = $("#middle_seq").val();
	var dataString = "mode=registMiddleDepartment&department_nm=" + department_nm + "&seq=" + seq + "&fid=" + fid + "&uid=" + uid;

	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") getMiddleDepartment();
			$("#middle_department_nm").val("");
			$("#middle_seq").val("");
			$("#middle_uid").val("");
		}
	});
}

function registSmallDepartment() {
	if(!check_str($("#small_department_nm").val(),"부서명")) return false;
	if(!check_str($("#small_seq").val(),"출력순서")) return false;

	var uid = $("#small_uid").val();
	var fid = $("#middle_uid").val();
	var department_nm = $("#small_department_nm").val();
	var seq = $("#small_seq").val();
	var dataString = "mode=registSmallDepartment&department_nm=" + department_nm + "&seq=" + seq + "&fid=" + fid + "&uid=" + uid;

	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") getSmallDepartment();
			$("#small_department_nm").val("");
			$("#small_seq").val("");
			$("#small_uid").val("");
		}
	});
}

function deleteBigDepartment(){
	if(!check_str($("#big_uid").val(),"부서명")) return false;
	var uid = $("#big_uid").val();
	var dataString = "mode=deleteBigDepartment&uid=" + uid;
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") {
				getBigDepartment();
			} else if(str == "son") {
				alert("하위 카테고리를 먼저 삭제하시고 진행하세요");
				return false;
			}
		}
	});
}

function deleteMiddleDepartment(){
	if(!check_str($("#middle_uid").val(),"부서명")) return false;
	var uid = $("#middle_uid").val();
	var dataString = "mode=deleteMiddleDepartment&uid=" + uid;
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") {
				getMiddleDepartment();
			} else if(str == "son") {
				alert("하위 카테고리를 먼저 삭제하시고 진행하세요");
				return false;
			}
		}
	});
}

function deleteSmallDepartment(){
	if(!check_str($("#small_uid").val(),"부서명")) return false;
	var uid = $("#small_uid").val();
	var dataString = "mode=deleteSmallDepartment&uid=" + uid;
	$.ajax({
		type : "post",
		data : dataString,
		url : "ajax/base.php",
		success : function(str) {
			if(str == "success") getSmallDepartment();
		}
	});
}
</script>

<script type="text/javascript">
	jQuery(function($) {		
		$.mask.definitions['~']='[+-]';
		$('.input-mask-date').mask('99/99/9999');
		$('.input-mask-phone').mask('(999) 999-9999');
		$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
		$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
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
		
		/////////
		$('#modal-form input[type=file]').ace_file_input({
			style:'well',
			btn_choose:'Drop files here or click to choose',
			btn_change:null,
			no_icon:'ace-icon fa fa-cloud-upload',
			droppable:true,
			thumbnail:'large'
		})
				
		//chosen plugin inside a modal will have a zero width because the select element is originally hidden
		//and its width cannot be determined.
		//so we set the width after modal is show
		$('#modal-form').on('shown.bs.modal', function () {
			if(!ace.vars['touch']) {
				$(this).find('.chosen-container').each(function(){
					$(this).find('a:first-child').css('width' , '210px');
					$(this).find('.chosen-drop').css('width' , '210px');
					$(this).find('.chosen-search input').css('width' , '200px');
				});
			}
		})
		/**
		//or you can activate the chosen plugin after modal is shown
		//this way select element becomes visible with dimensions and chosen works as expected
		$('#modal-form').on('shown', function () {
			$(this).find('.modal-chosen').chosen();
		})
		*/
				
		$(document).one('ajaxloadstart.page', function(e) {
			autosize.destroy('textarea[class*=autosize]')		
			$('.limiterBox,.autosizejs').remove();
			$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
		});	
	});
</script>