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
				<li class="active">출하지시 등록</li>
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
					출하지시 등록
					<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						출하지시 수량을 입력하시면 됩니다
					</small>
				</h1>
			</div><!-- /.page-header -->
			<!--// 서브제목과 라인 -->

			<div class="row">
				<div class="col-xs-12">
					<!-- PAGE CONTENT BEGINS -->
					<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data">
						<input type="hidden" name="controller" id="controller" value="sales" />
						<input type="hidden" name="action" id="action" value="registOrder" />
						<input type="hidden" name="uid" id="uid" value="<?=$t->uid?>" />

						<!-- 테이블 -->
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">주문서코드</th>
								<td class="col-xs-5" colspan="3">
									<input type="text" name="order_cd" id="order_cd" value="<?=$t->order_cd?>" readonly />
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">견적서코드</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="estimate_uid" id="estimate_uid" value="<?=$t->estimate_uid?>" readonly />
												<input type="text" name="estimate_cd" id="estimate_cd" value="<?=$t->estimate_cd?>" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog1">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">거래처</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="account_cd" id="account_cd" value="<?=$t->account_cd?>" readonly />
												<input type="text" name="account_nm" id="account_nm" value="<?=$t->account_nm?>" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog2">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">담당자</th>
								<td class="col-xs-5"><input type="text" name="manager" id="manager" value="<?=$t->manager?>"/> * 거래처 담당자</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">출하창고</th>
								<td class="col-xs-5">
									<select name="warehouse_cd" id="warehouse_cd">
										<option>출하창고 선택</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">거래유형</th>
								<td class="col-xs-5">
									<select name="tax_type" id="tax_type" onchange="tax_calculation(this.value)">
										<option value="1" <? if($t->tax_type == 1) echo "selected"; ?>>부가세율 적용</option>
										<option value="2" <? if($t->tax_type == 2) echo "selected"; ?>>부가세율 미적용</option>
									</select>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">통화</th>
								<td class="col-xs-5">
									<select name="currency" id="currency">
										<option value="1" <? if($t->currency == 1) echo "selected"; ?>>내자</option>
										<option value="2" <? if($t->currency == 2) echo "selected"; ?>>달러</option>
										<option value="3" <? if($t->currency == 3) echo "selected"; ?>>바트</option>
										<option value="4" <? if($t->currency == 4) echo "selected"; ?>>엔화</option>
										<option value="5" <? if($t->currency == 5) echo "selected"; ?>>위안</option>
										<option value="6" <? if($t->currency == 6) echo "selected"; ?>>유로</option>
									</select>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">프로젝트</th>
								<td class="col-xs-5">
									<div class="input-group">
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input type="hidden" name="project_cd" id="project_cd" value="<?=$t->project_cd?>" readonly />
												<input type="text" name="project_nm" id="project_nm" value="<?=$t->project_nm?>" readonly />
												<span class="input-group-addon btn-purple" id="id-btn-dialog3">
													<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
								<th class="col-xs-1" style="background-color:#f1f1f1">참조</th>
								<td class="col-xs-5"><input type="text" name="refer" id="refer" value="<?=$t->refer?>" /></td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">결제조건</th>
								<td class="col-xs-5"><input type="text" name="payment_condition" id="payment_condition" value="<?=$t->payment_condition?>" /></td>
								<th class="col-xs-1" style="background-color:#f1f1f1">납품기한</th>
								<td class="col-xs-5">
									<div>
										<span class="input-icon input-icon-right">
											<div class="input-group">
												<input class=" date-picker" name="delivery_dt" id="delivery_dt" type="text" value="<?=substr($t->delivery_dt,0,10)?>" data-date-format="yyyy-mm-dd" />
												<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
												</span>
											</div>
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">첨부</th>
								<td colspan="3" class="col-xs-11">
									<?= $t->attach ?>
									<input type="file" name="attach" id="attach" />
								</td>
							</tr>
						</table>
						
						<table id="product" class="table  table-bordered table-hover" style="margin-top:10px">
							<thead>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">품목코드</th>
									<th class="col-xs-1" style="background-color:#f1f1f1">품목명</th>
									<th class="col-xs-1" style="background-color:#f1f1f1">규격</th>
									<th class="col-xs-1" style="background-color:#f1f1f1">규격</th>
									<th class="col-xs-1" style="background-color:#f1f1f1">규격</th>
									<th class="col-xs-1" style="background-color:#f1f1f1">보유창고</th>
									<th class="col-xs-1" style="background-color:#f1f1f1">납품수량</th>
									<th class="col-xs-1" style="background-color:#f1f1f1">재고수량</th>
									<th class="col-xs-1" style="background-color:#f1f1f1">출하수량</th>
									<th class="col-xs-1" style="background-color:#f1f1f1">출하상태</th>
									<th class="col-xs-1" style="background-color:#f1f1f1">바코드</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</form>
				</div>
			</div><!-- /.row -->
			<div class="clearfix form-actions center">
				<div class="col-md-12">
					<button class="btn" type="reset" onclick="location.href = 'index.php?controller=sales&action=listPageOrderShipment' ">
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

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	var page = $("#page").val();
	getWarehouse();
	getOrderShipmentItem();

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

function registShipment( flag, item_cd, standard1, standard2, standard3, cnt, warehouse_cd ){
	var order_cd = "<?=$t->order_cd?>";
	var out_cnt = $("#out_cnt_" + flag).val();
	var dataString = "mode=registShipment&order_cd=" + order_cd + "&item_cd=" + item_cd + "&standard1=" + standard1 + "&standard2=" + standard2 + "&standard3=" + standard3 + "&out_cnt=" + out_cnt + "&warehouse_cd=" + warehouse_cd;
	
	if(out_cnt > cnt) {
		alert("출하수량이 납품할 수량보다 클 수 없습니다");
		return false;
	} else if(out_cnt == "" || out_cnt ==0) {
		alert("출하수량을 입력하세요");
		return false;
	} else {
		alert(dataString);
		$.ajax({
			type : "post",
			data : dataString,
			url : "ajax/sales.php",
			success : function(str) {
				if(str == "success") getOrderShipmentItem(1);
			}
		});
	}
}

// 창고 리스트 가져오기
function getWarehouse(){
	var rpp = 15;
	var adjacents = 4;
	var tag = "";
	var page = 1;
	var search = $("#where").val();
	var warehouse_gb = $("#warehouse_gb").val();

	$.getJSON("ajax/warehouse.php",{"page":page, "mode":"getWarehouse", "rpp" : rpp, "adjacents" : adjacents, "where":search, "warehouse_gb":warehouse_gb},
		function(json){
			if(json != null) {
				//$("#total_num").html(json[0].total_num);
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].warehouse_cd + "'>" + json[i].warehouse_nm + "</option>";
				}
			}

			$("#warehouse_cd").append(tag);
		}
	);
}


function getOrderShipmentItem(){
	var order_cd = $("#order_cd").val();
	var currentFlag = $("#flag").val();
	var tag = "";

	$.getJSON("ajax/order.php",{"mode":"getOrderShipmentItem", "order_cd" : order_cd},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag = "";
					tag += "<tr class='item" + currentFlag + "'>";
					tag += "<td>" + json[i].item_cd + "</td>";
					tag += "<td>" + json[i].item_nm + "</td>";
					tag += "<td>" + json[i].standard1 + "</td>";
					tag += "<td>" + json[i].standard2 + "</td>";
					tag += "<td>" + json[i].standard3 + "</td>";
					tag += "<td>" + json[i].warehouse_nm + "</td>";
					tag += "<td>" + json[i].cnt + "</td>";
					tag += "<td>" + json[i].stock_cnt + "</td>";
					
					if(json[i].cnt == 0) tag += "<td></td>";
					else tag += "<td><input type='text' class='form-control' name='out_cnt[]' id='out_cnt_" + currentFlag + "' /></td>";

					if(json[i].stock_cnt < json[i].cnt) {
						tag += "<td class='center'><input type='button' class='btn btn-xs btn-danger' value='재고수량부족' /></td>";
					} else {
						if(json[i].cnt == 0) tag += "<td class='center'><input type='button' class='btn btn-xs btn-danger' value='출하완료' /></td>";
						else tag += "<td class='center'><input type='button' class='btn btn-xs btn-success' value='출하지시 등록' onclick=\"registShipment(" + currentFlag + ",'" + json[i].item_cd + "','" + json[i].standard1 + "','" + json[i].standard2 + "','" + json[i].standard3 + "'," + json[i].cnt + ",'" + json[i].warehouse_cd + "')\" /></td>";
					}

					tag += "<td><input type='button' class='btn btn-xs btn-success' value='바코드인쇄' /></td>";
					tag += "</tr>";
					$("#product tbody").html(tag);
					
					currentFlag = Number(currentFlag) + 1;
					$("#flag").val(currentFlag);
					
				}
			}
		}
	);
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