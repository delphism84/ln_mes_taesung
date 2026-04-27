<?
require_once("library/caseby.php");
$sql = "select * from menu_setting";
$this->query($sql);
$t = $this->fetch();
?>

<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row" style="margin-top:10px">
				<div class="col-xs-12">
                	<form name="frm" id="frm">
						<input type="hidden" name="mode" id="mode" value="registMenuSetting" />

						<table id="simple-table" class="table table-bordered table-bordered">
							<tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 기준정보관리</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="base" id="base" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->base == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 수주.영업관리</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="sales" id="sales" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->sales == "y") echo "checked"; ?> /><span class="lbl"></span>																		
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 생산관리</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="production" id="production" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->production == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 품질관리</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="qc" id="qc" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->qc == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
                            <tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 외주.사급관리</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="outsourcing" id="outsourcing" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->outsourcing == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
                            <tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 구매.입고관리</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="purchase" id="purchase" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->purchase == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
                            <tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 출고.출하관리</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="release" id="release" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->releases == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
                            <tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 재고관리</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="items" id="items" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->items == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
                            <tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 금형관리</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="mold" id="mold" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->mold == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
                            <tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 시설물관리</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="machine" id="machine" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->autoItemMinus == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
                            <tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 인사.급여관리</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="wage" id="wage" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->wage == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
                            <tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 그룹웨어</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="groupware" id="groupware" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->groupware == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
                            <tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 경영지원</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="accounting" id="accounting" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->accounting == "y") echo "checked"; ?> /><span class="lbl"></span>									
								</td>
							</tr>
						</table>

						<div align="center"><input type="button" class="btn btn-lg btn-primary" value="환경설정 저장" onclick="formSubmit()" /></div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
function formSubmit(){
	var parameter = $("#frm").serialize();
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success : function(){
			showAlert("환경설정을 등록하였습니다");
            location.reload();
		}
	});
}
</script>