<?
require_once("library/caseby.php");
?>
<div class="main-content">
	<div class="main-content-inner">
		<?=$this->headNavi($controller_txt, $action_txt); ?>

		<div class="page-content">			
			<div class="col-xs-12">
				<!-- page -->
				<input type="hidden" name="page" id="page" value="1" />
				<div >
					<div>
						<div>
							<div class="panel">
								<div id="schedule_info" class="mt10 info">
									<div class="fr">
										<input type="button" class="comm_title" value="월간일정" />
										<!--<div style="float:right"><input type="button" class="btn btn-xs btn-info" value="일정등록" onclick="registSchedule()" /></div>-->
									</div>
					
									<div style="clear:both"></div>
									<?
									if(!$_GET['date']) {
										$year = date('Y'); 
										$month = date('m'); 
									} else {
										$date = explode("-",$_GET['date']);
										$year = $date[0];
										$month = $date[1];
									}

									$time = strtotime($year.'-'.$month.'-01'); 
									list($tday, $sweek) = explode('-', date('t-w', $time));  // 총 일수, 시작요일 
									$tweek = ceil(($tday + $sweek) / 7);  // 총 주차 
									$lweek = date('w', strtotime($year.'-'.$month.'-'.$tday));  // 마지막요일 

									$stmptime = strtotime($year."-".$month."-".date('d')); 
									$prev_month = date("Y-m-d",strtotime("-1 month", $stmptime)); 
									$next_month = date("Y-m-d",strtotime("+1 month", $stmptime));
									?>
					
									<table class="table table-bordered mt10">
										<colgroup>
											<col width="14.2%"/>
											<col width="14.2%"/>
											<col width="14.2%"/>
											<col width="14.2%"/>
											<col width="14.2%"/>
											<col width="14.2%"/>
											<col width="14.2%"/>
										</colgroup>
										<thead>
											<tr>
												<td colspan="7" class="gradient_gray" style="text-align:center">
													<span><a href="index.php?controller=groupware&action=frmSchedule&date=<?=$prev_month?>"  style="color:black; text-decoration:none">◀◀</a> </span>
													<span style="font-size:14pt; font-weight:bold"><?= $year."년 ".$month."월"?></span>
													<span> <a href="index.php?controller=groupware&action=frmSchedule&date=<?=$next_month?>" style="color:black; text-decoration:none">▶▶</a></span>
												</td>
											</tr>
											<tr>
												<th class="gradient_red">일</th>
												<th class="gradient_blue">월</th>
												<th class="gradient_blue">화</th>
												<th class="gradient_blue">수</th>
												<th class="gradient_blue">목</th>
												<th class="gradient_blue">금</th>
												<th class="gradient_orange">토</th>
											</tr>
										</thead>
										<tbody>
										<? 
										for ($n=1,$i=0; $i<$tweek; $i++){
											echo "<tr>";
											for ($k=0; $k<7; $k++){
												echo "<td style='cursor:pointer; vertical-align:top'>";
												
												if (!(($i == 0 && $k < $sweek) || ($i == $tweek-1 && $k > $lweek))){
													echo "<div style='width:30px; float:left'>";
													echo $n++;
													echo "</div>";
													
													if($n-1 < 10) $day = "0".$n-1;
													else $day = $n-1;
													
													$day = str_pad($day,2, "0", STR_PAD_LEFT);

													$date = $year."-".$month."-".$day;
													$query = "select * from schedule where emp_id='".$_SESSION['login_id']."' and schedule_dt='$date'";
													//echo $query;
													$result = mysql_query($query);
													echo "<div style='float:left; '>";
													while($t = mysql_fetch_object($result)){
														if($t->importance == "★★★" ) echo "<span style='color:red'>★★★</span>&nbsp;";
														if($t->importance == "★★☆" ) echo "<span style='color:red'>★★☆</span>&nbsp;";
														if($t->importance == "★☆☆" ) echo "<span style='color:red'>★☆☆</span>&nbsp;";
														
														if($t->classify == "수주") $color = "brown"; else $color = "black"; 
														if($t->title != "") echo "<span style='font-weight:bold; color:".$color."' onclick='viewSchedule(".$t->uid.")'>".mb_substr($t->title,0,12, 'utf-8')."</span><br>";
														else echo "<span style='font-weight:bold; color:".$color."' onclick='location.href = \"index.php?controller=groupware&action=modifyPageSchedule&uid=".$t->uid."\"'>".$t->name."</span><br>";
													}
													echo "</div>";
													echo "<div class='clear'></div>";
												}

												echo "</td>";
											}
											echo "</tr>";
										}
										?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>



<div class="modal fade" id="scheduleModal" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header" style="background:#007bff">
				<span style="font-weight:bold; color:#fff; font-size:14pt">상세보기</span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body" style="overflow-y: scroll; height:500px">
				<form id="frm">
					<input type="hidden" name="mode" id="mode" value="registSchedule" />
					<input type="hidden" name="uid" id="uid" />
					<table class="table  table-bordered table-hover">
						<tr>
							<? $this->th("제목") ?>
							<td><input type="text" class="form-control" name="title" id="title" validation="yes" err="제목을 입력하세요" readonly/></td>
						</tr>

						<tr>
							<? $this->th("기념일여무") ?>
							<td style="vertical-align:middle">
								<label>
									<input type="radio" class="ace" name="anniversary" id="isAnniversary" value="y" disabled/>
									<span class="lbl" > 기념일</span>
								</label>
								<label>
									<input type="radio" class="ace" name="anniversary" id="isAnniversary" value="n" checked disabled/>
									<span class="lbl" > 비기념일</span>
								</label>
							</td>
						</tr>
						<tr>
							<? $this->th("일정구분") ?>
							<td style="vertical-align:middle">
								<label>
									<input type="radio" class="ace" name="classify" id="classify" value="개인" checked disabled/>
									<span class="lbl"> 개인</span>
								</label>
								<label>
									<input type="radio" class="ace" name="classify" id="classify" value="부서" disabled/>
									<span class="lbl"> 부서</span>
								</label>
								<label>
									<input type="radio" class="ace" name="classify" id="classify" value="사내" disabled/>
									<span class="lbl"> 사내</span>
								</label>
							</td>
						</tr>
						<tr>							
							<? $this->th("고객명") ?>
							<td><input type="text" name="name" id="name" readonly/></td>
						</tr>
						<tr>
							<? $this->th("약속일") ?>
							<td>
								<span class="input-icon input-icon-right">
									<div class="input-group">
										<input class=" date-picker" type="text" data-date-format="yyyy-mm-dd" name="schedule_dt" id="schedule_dt" validation="yes" err="약속일을 입력하세요" disabled/>
										<span class="input-group-addon">
											<i class="fa fa-calendar bigger-110"></i>
										</span>
									</div>
								</span>
							</td>
						</tr>
						<tr>							
							<? $this->th("약속시간") ?>
							<td>
								<select name="schedule_tm" id="schedule_tm" disabled>
									<option value='09:00'>09:00</option>
									<option value='10:00'>10:00</option>
									<option value='11:00'>11:00</option>
									<option value='12:00'>12:00</option>
									<option value='13:00'>13:00</option>
									<option value='14:00'>14:00</option>
									<option value='15:00'>15:00</option>
									<option value='16:00'>16:00</option>
									<option value='17:00'>17:00</option>
									<option value='18:00'>18:00</option>
									<option value='19:00'>19:00</option>
									<option value='20:00'>20:00</option>
									<option value='21:00'>21:00</option>
									<option value='22:00'>22:00</option>
								</select>
							</td>
						</tr>
						<tr>
							<? $this->th("약속장소") ?>
							<td><input type="text" class="form-control" name="place" id="place" readonly/></td>
						</tr>
						<tr>							
							<? $this->th("중요도") ?>
							<td style="vertical-align:middle">
								<label>
									<input type="radio" class="ace" name="importance" id="importance" value="★★★" checked disabled/>
									<span class="lbl"> 상</span>
								</label>
								<label>
									<input type="radio" class="ace" name="importance" id="importance" value="★★☆" disabled/>
									<span class="lbl"> 중</span>
								</label>
								<label>
									<input type="radio" class="ace" name="importance" id="importance" value="★☆☆" disabled/>
									<span class="lbl"> 하</span>
								</label>
							</td>
						</tr>
						<tr>
							<? $this->th("메모") ?>
							<td colspan="3"><textarea class="form-control" rows="10" name="memo" id="memo" readonly></textarea></td>
						</tr>
					</table>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<div style="text-align:center">
					<!--<button type="button" class="btn btn-sm btn-info" id="btnSubmit">등록</button>-->
					<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">닫기</button>
					<!--<button type="button" class="btn btn-sm btn-danger" onclick="deleteSchedule()">삭제</button>-->
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
// 업무공유 모달창 띄우기
function registSchedule() {
	showModal("scheduleModal");
}

function viewSchedule(uid) {
	var parameter = {"mode" : "getSchedule", "uid" : uid};
	$.getJSON("ajax.php", {"parameter" : parameter}, function(json) {
		if(json != null) {
			$("#uid").val(json.uid);
			$("#title").val(json.title);
			$('input[name="anniversary"]:radio[value="' + json.anniversary + '"]').prop('checked',true);
			$('input[name="classify"]:radio[value="' + json.classify + '"]').prop('checked',true);
			$("#name").val(json.name);
			$("#schedule_dt").val(json.schedule_dt);
			$("#schedule_tm").val(json.schedule_tm);
			$("#place").val(json.place);
			$('input[name="importance"]:radio[value="' + json.importance + '"]').prop('checked',true);
			$("#memo").val(json.memo);
		}

		showModal("scheduleModal");
	});	
}

$(document).ready(function(){
	$(".onlynum").keyup(function(){$(this).val( $(this).val().replace(/[^0-9]/g,"") );} );

	// 등록
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
				timeout: 5000,
				success: function (data) {
					location.reload();
					$("#btnSubmit").prop("disabled", false);

				},
				error: function (e) {
					$("#btnSubmit").prop("disabled", false);

				}
			});
		}
	});
});

//==================================================
// 등록 폼 비우기
//==================================================
function formClear() {
	$("#uid").val("");
	$("#frm")[0].reset();
}

function deleteSchedule() {
	var parameter = {"mode" : "deleteSchedule", "uid" : $("#uid").val()};
	$.ajax({
		type : "post",
		data : parameter,
		url : "ajax.php",
		success: function(str) {
			location.reload();
		}
	});
}
</script>