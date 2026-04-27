<!--html / css작업-->
<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<style>
		/*=============================== 내용 ===============================*/	
	
		
		/*=============================== 내용 ===============================*/
	</style>
	<div class="main-content-inner">
	<?=$this->headNavi($controller_txt, $action_txt); ?>
		<div class="page-content">
		
			<div>
				
			</div>
			
			<div style="clear:both"></div>			
			<div class="row">
				<div class="col-xs-12">
				<!--=============================== 내용 ===============================-->
				<div class="row box1">
					<div class="col-md-12" style="display: table;">
						<table class="table table-bordered">
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1; width:20%;">기간</th>
								<td>
									<input type="text" name="day" id="day" />	
								</td>
							</tr>
							<tr>
								<th class="col-xs-1" style="background-color:#f1f1f1">공정</th>
								<td style="vertical-align:middle">
									<?
									$sql = "select * from process";
									$this->query($sql);
									$i = 0;
									while($t = $this->fetch()){
										echo "<label class='pos-rel'>";
										echo "<input type='checkbox' class='pc' id='process_".$i."' value='".$t->uid."' onclick='getMachine();' />";
										echo "<span class='lbl'>&nbsp;".$t->process_nm."</span>";
										echo "</label>&nbsp;&nbsp;";
										$i++;
									}
									?>														
								</td>
							</tr>
							<tr>
								<td class="col-xs-1" style="background-color:#f1f1f1">설비</td>
								<td>
									<div id="machine_area"></div>
								</td>
							</tr>
						</table>
					</div>
					<div align="center"><input type="button" class="btn btn-sm btn-primary" value="검색" onclick="search()" /></div>
					<div class="col-xs-12" style="margin-top:15px">
						<table class="table table-bordered table-striped" id="tb">
							<thead></thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
				<!--=============================== 내용 ===============================-->					
				</div>				
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="per" id="per" value="11" />

<?
$this->hidden();
$this->alertModal();
$this->confirmModal();
require_once ("assets/include_script.php");
?>


<script>
function search(){
	var day_cnt = $("#day").val();
	var thead = "";

	thead += "<tr>";
	thead += "<th class='col-xs-1'>공정</th>";
	thead += "<th class='col-xs-1'>설비</th>";

	var today = new Date();
	var mm = today.getMonth() + 1;
	var yyyy = today.getFullYear();

	var lastDay = ( new Date( yyyy, mm, 0) ).getDate();	

	for(var i = 0 ; i < Number(day_cnt) ; i++) {
		var dd = today.getDate() + i;
		
		if(dd > lastDay) {
			dd = dd - lastDay;
			thead += "<th>" + dd + "</th>";		
		} else {
			thead += "<th>" + dd + "</th>";		
		}
		
	}

	thead += "</tr>";

	$("#tb thead").html(thead);

	getData();
}	


function getMachine() {
	var where  = "";
	var arr = new Array();

	$(".pc").each(function(){
		if($(this).is(":checked") == true) {
			arr.push($(this).val());
		}		
	});

	for(var i = 0 ; i < arr.length ; i++){
		if(i == 0) where = "where process_cd=" + arr[i];
		else where += " or process_cd=" + arr[i];
	}

	var parameter = {"mode" : "getProductProcessMachine", "where" : where};
	var tag = "";
	$.getJSON("ajax.php",{"parameter" : parameter},function(json){
		if(json != null){
			for (var i  = 0 ; i < json.length ; i++){
				tag += "<label class='pos-rel'><input type='checkbox' class='mc' id='machine_" + i + "' value='" + json[i].uid + "' /><span class='lbl'>&nbsp;" + json[i].machine_nm + "</span></label>&nbsp;&nbsp;";
			}

			$("#machine_area").html(tag);
		}
	});
}

//==================================================
// 작업지시서 리스트
//==================================================
function getData(){
	var where  = "";
	var pc_arr = new Array();	
	var mc_arr = new Array();

	$(".pc").each(function(){
		if($(this).is(":checked") == true) {
			pc_arr.push($(this).val());
		}		
	});

	if(pc_arr.length > 0) {
		for(var i = 0 ; i < pc_arr.length ; i++){
			if(i == 0) where = "where (process=" + pc_arr[i];
			else where += " or process=" + pc_arr[i];
		}

		where += ")";
	}

	$(".mc").each(function(){
		if($(this).is(":checked") == true) {
			mc_arr.push($(this).val());
		}		
	});

	if(mc_arr.length > 0) {
		where += " and ("
		for(var i = 0 ; i < mc_arr.length ; i++){
			if(i == 0) where += "machine=" + mc_arr[i];
			else where += " or machine=" + mc_arr[i];
		}
		where += ")";
	}

	//alert(where);

	$("#where").val(where);


	var tag = "";
	var parameter = {"mode" : "getDayWorkList", "where" : $("#where").val(), "day" : $("#day").val()};

	$.getJSON("ajax.php",{"parameter" : parameter},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					
					tag += "<tr>";

					tag += "<td>" + json[i].process_nm + "</td>";
					tag += "<td>" + json[i].machine_nm + "</td>";
					
					var bool = false;
					var day_cnt = $("#day").val();
					var today = new Date();
					var mm = today.getMonth() + 1;
					if(mm < 10) mm = '0' + mm;
					var yyyy = today.getFullYear();

					var lastDay = ( new Date( yyyy, mm, 0) ).getDate();	

					for(var k = 0 ; k < Number(day_cnt) ; k++) {
						var dd = today.getDate() + k;
						if(dd < 10) dd = '0' + dd;
						
						if(dd > lastDay) {
							dd = dd - lastDay;
							if(dd < 10) {
								dd = '0' + dd;
							}

							if(bool == false) {
								mm = today.getMonth() + 2;
								bool = true;
							}

							var tt = yyyy + "-" + mm + "-" + dd;
							
							if(json[i].work_dt == tt) {
								tag += "<td>" + json[i].item_nm + "(" + json[i].cnt + ")</td>";		
							} else {
								tag += "<td></td>";
							}
						} else {
							var tt = yyyy + "-" + mm + "-" + dd;

							if(json[i].work_dt == tt) {
								tag += "<td>" + json[i].item_nm + "(" + json[i].cnt + ")</td>";		
							} else {
								tag += "<td></td>";
							}		
						}
						
					}

					tag += "</tr>";
				}
			} else {
				tag = "<tr><td colspan='" + Number($("#day").val()) + 2 + "' style='padding:20px; color:red; font-weight:bold; text-align:center'>데이터가 존재하지 않습니다</td></tr>";
			}
			
			$("#tb tbody").html(tag);
		}
	);
}
</script>