<?
require_once("library/caseby.php");
$sql = "select * from program_setting";
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
						<input type="hidden" name="mode" id="mode" value="registConfig" />

						<table id="simple-table" class="table table-bordered table-bordered">
							<tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 작업강제 시작</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="compulsionWork" id="compulsionWork" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->compulsionWork == "y") echo "checked"; ?> /><span class="lbl"></span>
									<span class="blue">* 생산라인에서 투입자재가 없어도 강제로 작업을 시작하게 합니다.</span>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 자동입고</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="autoIn" id="autoIn" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->autoIn == "y") echo "checked"; ?> /><span class="lbl"></span>									
									<span class="blue">* 구매발주서 작성과 동시에 자동입고 처리를 합니다</span>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 자동 생산불출</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="autoRelease" id="autoRelease" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->autoRelease == "y") echo "checked"; ?> /><span class="lbl"></span>
									<span class="blue">* 작업지시서 작성과 동시에 자동 원자재불출 처리를 합니다</span>
								</td>
							</tr>
							<tr>
								<th class="col-xs-2" style="vertical-align:middle; font-weight:bold; background-color:#f1f1f1"><i class="ace-icon fa fa-caret-right blue"> 자동 생산원자재 투입</th>
								<td class="col-xs-10" style="vertical-align:middle">
									<input name="autoItemMinus" id="autoItemMinus" value="y" class="ace ace-switch ace-switch-5" type="checkbox" <? if($t->autoItemMinus == "y") echo "checked"; ?> /><span class="lbl"></span>
									<span class="blue">* 생산작업완료시 자동으로 품목제조공정별 소요자재의 수량만큼 자재를 삭감합니다.</span>
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
		}
	});
}
</script>