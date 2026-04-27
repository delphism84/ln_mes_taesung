<?
//error_reporting(E_ALL);

//ini_set("display_errors", 1);


//$title = "금형 파일(이미지) 업로드";
//require_once("../../connection.php");
//require_once("../../assets/phead.php");
//require_once("../../library/function.php");
//require_once('../../connection.php');
//require_once('../../library/function.php');

//require_once("../../assets/phead.php");
//require_once('../../routes.php');

//extract($_POST);
//extract($_GET);
?>


					<div class="page-content">
						<div class="ace-settings-container" id="ace-settings-container">
							

	
						</div><!-- /.ace-settings-container -->

						<div class="page-header">
							<h1>
								제품 및 금형 사진
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Drag &amp; drop file upload with image preview
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="alert alert-info">
									<i class="ace-icon fa fa-hand-o-right"></i>

									제품 및 금형 이미지를 Drag &amp; drop 하시거나 click으로 파일찾기 후 업로드 하세요. 
									<button class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>
								</div>

								<div>
									<form name="frm" id="frm" method="post" action="index.php" enctype="multipart/form-data" class="dropzone well" >
										<input type="hidden" name="controller" id="controller" value="mold" />
										<input type="hidden" name="action" id="action" value="insertPageMoldFile" />
										<input type="hidden" name="fid" id="fid" value="<?=$uid?>" />
											<input type="file" name="attach" id="attach_1"/>
											<input type="file" name="attach" id="attach_2"/>
											<input type="file" name="attach" id="attach_3"/>
											<input type="file" name="attach" id="attach_4"/>
									</form>
								</div>

								<div id="preview-template" class="hide">
									<div class="dz-preview dz-file-preview">
										<div class="dz-image">
											<img data-dz-thumbnail="" />
										</div>

										<div class="dz-details">
											<div class="dz-size">
												<span data-dz-size=""></span>
											</div>

											<div class="dz-filename">
												<span data-dz-name=""></span>
											</div>
										</div>

										<div class="dz-progress">
											<span class="dz-upload" data-dz-uploadprogress=""></span>
										</div>

										<div class="dz-error-message">
											<span data-dz-errormessage=""></span>
										</div>

										<div class="dz-success-mark">
											<span class="fa-stack fa-lg bigger-150">
												<i class="fa fa-circle fa-stack-2x white"></i>

												<i class="fa fa-check fa-stack-1x fa-inverse green"></i>
											</span>
										</div>

										<div class="dz-error-mark">
											<span class="fa-stack fa-lg bigger-150">
												<i class="fa fa-circle fa-stack-2x white"></i>

												<i class="fa fa-remove fa-stack-1x fa-inverse red"></i>
											</span>
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
						<div class="clearfix  center">
						<div class="col-md-12">
							<button class="btn btn-xs btn-success" type="button" onclick="formSubmit()">
								<i class="ace-icon fa fa-check bigger-110"></i>
								파일등록
							</button>
							<button class="btn btn-xs btn-info" type="button" onclick="self.close()">
								<i class="ace-icon fa fa-check bigger-110"></i>
								창닫기
							</button>
						</div>
					</div><!-- // submit -->
					</div><!-- /.page-content -->
					
				</div>
			</div><!-- /.main-content -->
		
			

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<?
		require_once ("../../assets/include_script.php");
		?>
		<script src="../../assets/js/ace-elements.min.js"></script>
		<script src="../../assets/js/ace.min.js"></script>
		<script>
			function formSubmit(){
				
				if($("#attach_1").val() == "") {
					alert("파일을 하나이상 입력하세요.");
					$("#attach_1").focus()
					return false;
				}
				/*
				var dataString = "mode=checkItemCode&item_cd=" + $("#item_cd").val() + "&standard1=" + $("#standard1").val();
				$.ajax({
					type : "post",
					url : "ajax/base.php",
					data : dataString,
					success : function (str) {
						if(str == "false") {
							alert("중복된 품목코드와 규격을 가진 품목이 존재합니다");
							return false;
						} else {
							$("#frm").submit();
						}
					}
				});
				*/
				$("#frm").submit();
			}
		</script>
<script>
	$('#attach_1 , #attach_2 , #attach_3 , #attach_4').ace_file_input({
		no_file:'No File ...',
		btn_choose:'찾아보기',
		btn_change:'Change',
		droppable:false,
		onchange:null,
		thumbnail:true, //| true | large
		//whitelist:'gif|png|jpg|jpeg'
		blacklist:'exe|php',
		//onchange:''
		//
	});
</script>
<?
require_once("../../assets/pfoot.php");
?>
