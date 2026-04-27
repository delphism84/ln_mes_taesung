function show(cls){
				$("." + cls).toggle();
			}
			
			// 버튼의 글자를 바꾸기 위한 스크립트
			function change_btn_txt(obj, t1, t2){
				if($(obj).val() == t1) $(obj).val(t2);
				else $(obj).val(t1);
			} 

			// 버튼의 색상을 바꾸기 위한 스크립트
			function chang_btn_color(obj) {
				$(".show_layer_btn").each(function(){
					if($(this).hasClass("btn-info") == true) $(this).toggleClass("btn-info btn-default");
				});
				$(obj).toggleClass("btn-default btn-info");
			}

			function son_layer_display(obj){
				//$(".son .")
			}