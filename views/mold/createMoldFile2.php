<?require_once("assets/head_pop.php");?>
<?
session_start();
extract($_POST);
extract($_GET);
?>
	<div class="main-content">
		<div class="main-content-inner">
			<div class="page-content">
				<div class="row">
					<div class="col-xs-12">
						<!-- PAGE CONTENT BEGINS -->
						<div class="alert alert-info">
							<i class="ace-icon fa fa-hand-o-right"></i>

							제품 및 금형 이미지 사진 파일은 .gif .jpg, .bmp, .png 만 가능합니다.<br>
							<i class="ace-icon fa fa-hand-o-right"></i>
							찾아보기를 클릭 후 해당 제품 이미지를 선택하고 사진 추가 버튼을 클릭하세요. 
							<button class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
						</div>

						<div class="row">
							<div class="col-xs-12">

									<div class="widget-body ">
										<div class="widget-main no-padding">
										<table id="mold_list" class="table table-bordered table-striped ">
											<thead class="thin-border-bottom">
												<form name="frm[]" id="frm1" method="post" action="./" enctype="multipart/form-data">
												<input type="hidden" name="fid" id="fid" value="<?=$uid?>" />
												<input type="hidden" name="imode" id="imode" value="" />
												<tr>
													<th class="col-xs-1" style="background-color:#f1f1f1">첨부파일1</th>
													<td class="col-xs-2">
														<ul class="tdPic2 tdPic2_custom" id="tdPic1"></ul>
													</td>
													<td class="col-xs-7" style='vertical-align:bottom;line-height:50px;'>
														 <div class="plusPic">
															<input type="file" name="attach" id="attach_1" onchange="file_upload_check();"/>
														</div>
													</td>
													<td class="col-xs-1" style='vertical-align:top;line-height:50px;'>
														<button  class="btn btn-success btn-xs" id="idAddFileUpload1">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i> 사진추가
														</button>
													</td>
												</tr>
												</form>
												<form name="frm[]" id="frm2" method="post" action="./" enctype="multipart/form-data">
												<input type="hidden" name="fid" id="fid" value="<?=$uid?>" />
												<input type="hidden" name="imode" id="imode" value="" />
												<tr>
													<th class="col-xs-1" style="background-color:#f1f1f1">첨부파일2</th>
													<td class="col-xs-2">
														<ul class="tdPic2 tdPic2_custom" id="tdPic2"></ul>
													</td>
													<td class="col-xs-7" style='vertical-align:bottom;line-height:50px;'>
														 <div class="plusPic">
															<input type="file" name="attach" id="attach_2" onchange="file_upload_check();"/>
														</div>
													</td>
													<td class="col-xs-1" style='vertical-align:top;line-height:50px;'>
														<button class="btn btn-success btn-xs" id="idAddFileUpload2" >
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i> 사진추가
														</button>
													</td>
												</tr>
												</form>
												<form name="frm[]" id="frm3" method="post" action="./" enctype="multipart/form-data">
												<input type="hidden" name="fid" id="fid" value="<?=$uid?>" />
												<input type="hidden" name="imode" id="imode" value="" />
												<tr>
													<th class="col-xs-1" style="background-color:#f1f1f1">첨부파일3</th>
													<td class="col-xs-2">
														<ul class="tdPic2 tdPic2_custom" id="tdPic3"></ul>
													</td>
													<td class="col-xs-7" style='vertical-align:bottom;line-height:50px;'>
														 <div class="plusPic">
															<input type="file" name="attach" id="attach_3" onchange="file_upload_check();"/>
														</div>
													</td>
													<td class="col-xs-1" style='vertical-align:top;line-height:50px;'>
														<button class="btn btn-success btn-xs" id="idAddFileUpload3">
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i> 사진추가
														</button>
													</td>
												</tr>
												</form>
												<form name="frm[]" id="frm4" method="post" action="./" enctype="multipart/form-data">
												<input type="hidden" name="fid" id="fid" value="<?=$uid?>" />
												<input type="hidden" name="imode" id="imode" value="" />
												<tr>
													<th class="col-xs-1" style="background-color:#f1f1f1">첨부파일4</th>
													<td class="col-xs-2">
														<ul class="tdPic2 tdPic2_custom" id="tdPic4"></ul>
													</td>
													<td class="col-xs-7" style='vertical-align:bottom;line-height:50px;'>
														 <div class="plusPic">
															<input type="file" name="attach" id="attach_4" onchange="file_upload_check();"/>
														</div>
													</td>
													<td class="col-xs-1" style='vertical-align:top;line-height:50px;'>
														<button type="button" class="btn btn-success btn-xs" id="idAddFileUpload4" >
															<i class="ace-icon fa fa-search icon-on-right bigger-110" style="color:#ffffff"></i> 사진추가
														</button>
													</td>
												</tr>
												</form>
											</thead>
										</table>

								</form>
							</div>
						</div>
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
<link href="http://erp.comesta.com//weberp/css/reset.css" rel="stylesheet" type="text/css" media="all">
<link href="http://erp.comesta.com//weberp/css/common.css" rel="stylesheet" type="text/css" media="all">
		<!-- basic scripts -->

		<?
		require_once ("assets/include_script.php");
		?>
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<script>
			$(document).ready(function() {
				$("#idAddFileUpload1").click(function() { //파일 업로드 탐색창 오픈
					if($("#attach_1").val()==""){
						alert("파일을 먼저 선택하세요");
						return false;
					}
					file_upload_iframe(0);
				});
				$("#idAddFileUpload2").click(function() { //파일 업로드 탐색창 오픈
					if($("#attach_2").val()==""){
						alert("파일을 먼저 선택하세요");
						return false;
					}
					file_upload_iframe(1);
				});
				$("#idAddFileUpload3").click(function() { //파일 업로드 탐색창 오픈
					if($("#attach_3").val()==""){
						alert("파일을 먼저 선택하세요");
						return false;
					}
					file_upload_iframe(2);
				});
				$("#idAddFileUpload4").click(function() { //파일 업로드 탐색창 오픈
					if($("#attach_4").val()==""){
						alert("파일을 먼저 선택하세요");
						return false;
					}
					file_upload_iframe(3);
				});

				if($("#uid").val()!="") {
					selectImage(1);
					selectImage(2);
					selectImage(3);
					selectImage(4);
				}
			});
			
			function selected_file_clear(id)
			{
				var elementid = "#"+id;//alert(elementid);
				var ua = window.navigator.userAgent;
				var msie = ua.indexOf("MSIE ");
				if(msie>0) {//IE version
					$(elementid).replaceWith($(elementid).clone(true));
				} else {// other browser
				   $(elementid).val("");
				}
			}

			function file_upload_check()
				{
					if($("#uid").val()=="") {
							alert("금형코드가 없습니다.");
							selected_file_clear("attach_1");
							return;
						}
						
					if( $("#attach_1").val() != "" ){
						var ext = $("#attach_1").val().split('.').pop().toLowerCase();
						if($.inArray(ext, ['gif','png','jpg','jpeg','bmp']) == -1) {
							alert('gif,png,jpg,jpeg,bmp 파일만 업로드 할수 있습니다.');
							selected_file_clear("attach_1");
							return;
						}
					}
				}

				function file_upload_iframe(obj)
				{
					//var f = document.frm;
					var f = document.forms[obj];
					f.imode.value = "imgins";
					f.method = "post";
					f.action = "ajax/ajax_fileupload.php?imode=imgins";
					//f.target = "process";
					f.enctype= "multipart/form-data";
					f.submit();
				}

				function file_upload_result(retcd)
				{
					selected_file_clear("attach_1");
					if(retcd!=1)
					{
						alert("업로드 실패");return;
					}
					selectImage();
				}

			function selectImage(obj) //등록된 이미지 정보를 가져오는 함수
				{
					var param = 'imode=imglist&fid='+$("#fid").val();
					$.ajax({
						type: 'post'
						, url: 'ajax/ajax_base02_image.php'
						, data: param
						, datatype: 'json'
						, success: function(data) {
							var imgstr = "";
							$('#tdPic'+obj).empty();
							$(data).each(function() {
								uid		= $(this).attr('uid');	
								file_cd = $(this).attr('file_cd');
								file_nm = $(this).attr('file_nm');
								$('#image_filename').val(file_nm);
								if (file_nm=="")
								{
									var imgurl = "/assets/images/images.png";
								}else{
									var imgurl = "/attach/mold/" + file_nm;	
								}
								imgstr += "<li>";
								imgstr += "<a class='fancybox' href='" + imgurl + "'><img src='" + imgurl + "' alt='사진'></a>";
								imgstr += "<span class=\"delPic\"><a href=\"#\" title=\"사진삭제\" onclick=\"pic_del('"+uid+"')\"><img src=\"/assets/images/del_pic.png\" alt=\"사진삭제\" border='0'></a></span>";
								imgstr += "</li>";
							});
							
							$('#tdPic'+obj).append(imgstr);
						}
						, error: function(data, status, err) {
							alert("이미지 조회 에러!");
						}
						, complete: function() {}
					});
				}

				/****
			 * 이미지 x 버튼 클릭시 삭제 함수 
			 */
			function pic_del(pidx) {
				var param = "imode=imgdel&fid="+pidx;
				$.ajax({
					type: 'post'
					, url: 'ajax/ajax_base02_image.php'
					, data: param
					, datatype: 'json'
					, success: function(data) {
						if(data.pid == "1") {
							selectImage();
						} 
						else {
						}
					}
					, error: function(data, status, err) {
						alert("삭제 에러!");
					}
					, complete: function() {}
				});
			}
		</script>


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
				whitelist:'gif|png|jpg|jpeg',
				blacklist:'exe|php',
				//onchange:''
				//
			});
		</script>
		<iframe src="" width="0" height="0" frameborder="0" name="process"></iframe>
<?
require_once("../../assets/pfoot.php");
?>
