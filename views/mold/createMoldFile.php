<?require_once("assets/head_pop.php");?>
<?
session_start();
extract($_POST);
extract($_GET);
?>
<style type="text/css">

        input[type=file] {
            display: none;
        }

        .my_button {
            display: inline-block;
            width: 200px;
            text-align: center;
            padding: 10px;
            background-color: #006BCC;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
			font-size:15px;
			
        }
		.my_button:hover {
			color: #fff;
			text-decoration:underline;
		}
		.my_button:visited {
			color: #fff;
		}
        .imgs_wrap {

            border: 2px solid #A8A8A8;
            margin-top: 30px;
            margin-bottom: 30px;
            padding-top: 10px;
            padding-bottom: 10px;

        }
        .imgs_wrap img {
            max-width: 150px;
            margin-left: 10px;
            margin-right: 10px;
        }

    </style>
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
							찾아보기를 클릭 후 해당 제품 이미지를 선택하거나 여러 이미지를 한번에 선택 하세요. 삭제는 이미지를 클릭하세요.
							<button class="close" data-dismiss="alert">
								<i class="ace-icon fa fa-times"></i>
							</button>
						</div>

						<div class="row">
							<div class="col-xs-12">
								<div class="widget-body ">
									<div class="widget-main no-padding">
										<form name="frm" id="frm1" method="post" action="" enctype="multipart/form-data">
										<input type="hidden" name="fid" id="fid" value="<?=$uid?>" />
										<input type="hidden" name="dialogID" id="dialogID" value="<?=$dialogID?>" />
										<div>
											<div class="input_wrap">
												<a href="javascript:" onclick="fileUploadAction();" class="my_button">파일 찾기</a>
												<input type="file" id="input_imgs" multiple/>
											</div>
										</div>

										<div>
											<div class="imgs_wrap">
												<img id="img" />
											</div>
										</div>

										<a href="javascript:" class="my_button" onclick="submitAction();">파일 업로드</a>
										</form> 
									</div>
								</div>
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
				
			</div><!-- /.page-content -->
		</div>
	</div><!-- /.main-content -->
		
	<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
		<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
	</a>
	<link href="assets/css/file/reset.css" rel="stylesheet" type="text/css" media="all">
	<link href="assets/css/file/common.css" rel="stylesheet" type="text/css" media="all">
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
					//selectImage(1);
					//selectImage(2);
					//selectImage(3);
					//selectImage(4);
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
<script type="text/javascript" src="../../assets/js/jquery-3.1.0.min.js" charset="utf-8"></script>
    <script type="text/javascript">

        // 이미지 정보들을 담을 배열
        var sel_files = [];


        $(document).ready(function() {
            $("#input_imgs").on("change", handleImgFileSelect);
        }); 

        function fileUploadAction() {
            console.log("fileUploadAction");
            $("#input_imgs").trigger('click');
        }

        function handleImgFileSelect(e) {

            // 이미지 정보들을 초기화
            sel_files = [];
            $(".imgs_wrap").empty();

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            var index = 0;
            filesArr.forEach(function(f) {
                if(!f.type.match("image.*")) {
                    alert("확장자는 이미지 확장자만 가능합니다.");
                    return;
                }

                sel_files.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selProductFile' title='Click to remove'></a>";
                    $(".imgs_wrap").append(html);
                    index++;

                }
                reader.readAsDataURL(f);
                
            });
        }

        function deleteImageAction(index) {
            console.log("index : "+index);
            console.log("sel length : "+sel_files.length);

            sel_files.splice(index, 1);

            var img_id = "#img_id_"+index;
            $(img_id).remove(); 
        }

        function fileUploadAction() {
            console.log("fileUploadAction");
            $("#input_imgs").trigger('click');
        }

        function submitAction() {
            console.log("업로드 파일 갯수 : "+sel_files.length);
            var data = new FormData();

            for(var i=0, len=sel_files.length; i<len; i++) {
                var name = "image_"+i;
                data.append(name, sel_files[i]);
            }
            data.append("image_count", sel_files.length);
            
            if(sel_files.length < 1) {
                alert("한개이상의 파일을 선택해주세요.");
                return;
            }           
			
            var xhr = new XMLHttpRequest();
			var fid = $("#fid").val();

            xhr.open("POST","views/mold/study01_af.php?fid="+fid);
            xhr.onload = function(e) {
				if(this.status == 200) {
					alert("Result : "+e.currentTarget.responseText);
                    console.log("Result : "+e.currentTarget.responseText);
                }
            }
            xhr.send(data);
			window.parent.closeModal('<?=$dialogID?>');
			window.parent.getMoldFileList(fid);
        }

    </script>
<?
require_once("../../assets/pfoot.php");
?>
