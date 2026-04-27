
			
	</body>
</html>

<script src="assets/js/bScript.js"></script>


<script>
function getMenuCnt() {
	var parameter = {"mode" : "getMenuCnt"};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			if(json.obtain_order_cnt > 0) {
				$(".m_obtain_order_cnt").css("dispaly","block");
				$(".m_obtain_order_cnt").html(json.obtain_order_cnt);
				$(".menu_sales").html("V");
				$(".menu_production").html("V");
			}

			if(json.purchase_cnt > 0) {
				$(".m_purchase_cnt").css("dispaly","block");
				$(".m_purchase_cnt").html(json.purchase_cnt);
				$(".menu_purchase").html("V");
			}

			if(json.orders_cnt > 0) {
				$(".m_orders_cnt").css("dispaly","block");
				$(".m_orders_cnt").html(json.orders_cnt);
				$(".menu_purchase").html("V");
			}

			if(json.release_cnt > 0) {
				$(".m_release_cnt").css("dispaly","block");
				$(".m_release_cnt").html(json.release_cnt);
				$(".menu_release").html("V");
			}

			if(json.work_cnt > 0) {
				$(".m_work_cnt").css("dispaly","block");
				$(".m_work_cnt").html(json.work_cnt);
				$(".menu_production").html("V");
			}

			if(json.safety_cnt > 0) {
				$(".m_safety_cnt").css("dispaly","block");
				$(".m_safety_cnt").html(json.safety_cnt);
				$(".menu_item").html("V");
			}
		}
	});
}

//getMenuCnt();
//safetyStock();

//setInterval(function() {
//	getMenuCnt();
//}, 1000); // 1초에 한번


function safetyStock() {
	var parameter = {"mode" : "safetyStock"};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php"
	});
}
</script>