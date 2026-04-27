<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<? $this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">
			<div class="row">
				<div class="col-xs-12">
					<div>
						<form name="frm" id="frm">
							<input type="hidden" name="mode" id="mode" value="registExcel" />
							<!-- 테이블 -->
							<table id="simple-table" class="table  table-bordered table-hover">
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1; width:40%;">구분</th>
									<td class="col-xs-11">
										<select name="excel_gb" id="excel_gb">
											<option value="item">품목</option>
											<option value="account">거래처</option>
											<option value="employee">사원</option>
											<option value="tax">소득세</option>
										</select>									
									</td>
								</tr>
								<tr>
									<th class="col-xs-1" style="background-color:#f1f1f1">첨부</th>
									<td class="col-xs-11"><input type="file" name="attach" id="attach" validation="yes" err="첨부파일을 선택하세요" /></td>
								</tr>
							</table>
						</form>
					</div>
					<div>
						<table id="simple-table" class="table  table-bordered table-hover">
							<tr>
								<? $this->th("구분"); ?>
								<? $this->th("샘플파일"); ?>
							</tr>
							<tr>
								<? $this->th("사원 EXCEL"); ?>
								<td class="col-xs-11"><a href='index.php?controller=document&action=download&file=excel_sample/employee_sample.xls'>사원등록 엑셀 샘플 다운로드</a></td>
							</tr>
							<tr>
								<? $this->th("거래처 EXCEL"); ?>
								<td class="col-xs-11"><a href='index.php?controller=document&action=download&file=excel_sample/account_sample.xls'>거래처 엑셀 샘플 다운로드</a></td>
							</tr>
							<tr>
								<? $this->th("품목 EXCEL"); ?>
								<td class="col-xs-11"><a href='index.php?controller=document&action=download&file=excel_sample/item_sample.xls'>품목등록 엑셀 샘플 다운로드</a></td>
							</tr>
						</table>
					</div>
					<div class="col-md-12 center" style="width:100%;">
						<button class="btn btn-info" type="button" id="btnSubmit">
							<i class="ace-icon fa fa-check bigger-110"></i>
							<span id="btnSubmitTxt">엑셀 등록</span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?=$this->alertModal()?>

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>

<script>
$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	// 품목등록
	$("#btnSubmit").click(function (event) {
		if(check("frm")) {
			event.preventDefault();
			var form = $('#frm')[0];
			var data = new FormData(form);
			data.append("CustomField", "This is some extra data, testing");
			$("#btnSubmit").prop("disabled", true);

			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: "ajax.php",
				data: data,
				processData: false,
				contentType: false,
				cache: false,
				timeout: 600000,
				success: function (data) {
					showAlert("엑셀을 처리하였습니다");
					$("#btnSubmit").prop("disabled", false);
				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);

				}
			});
		}
	});

});
</script>