<?
extract($_POST);
extract($_GET);

$title = "부서검색";

require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");

if ( ! isset ( $where ) ) $where = "";

$table = "erp_department_big";
$block = 10;

$sql = "select * from ".$table.$where;
$total_num = num_rows($sql);

$page = (is_numeric($page)) ? $page : 1; 

$sql = "select * from ".$table.$where." order by seq desc limit ".($page-1)*$block.", ".$block;
$result = query($sql);
?>

<script>
$(document).ready(function(){
	var table = "erp_department_big";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;

	getPaging(table,where,rpp,adjacents);

	getBigDepartment();
});

function postDepartment(emp_id,emp_nm) {
	$(opener.document).find("#department_cd").val(emp_id);
	$(opener.document).find("#department_nm").val(emp_nm);
	self.close();
}


// 페이지 세트
function setPage(page){
	$("#page").val(page);
	location.href = "?page=" + page + "&where=" + $("#where").val() + "&account_gb=" + $("#account_gb option:selected").val();
}

// 페이징 가져오기
function getPaging(table,where,rpp,adjacents){
	var data_string = "page=" + $("#page").val() + "&table=" + table + "&where=" + where + "&rpp=" + rpp + "&adjacents=" + adjacents;

	$.ajax({
		type : "post",
		url : "../../_get_paging.php",
		data : data_string,
		success : function(str) {
			$("#paging_area").html(str);
		}
	});
}

function setGb(val) {
	if(val == "all") $("#where").val("");
	else $("#where").val(" where account_gb='" + val + "'");
	setPage(1);
}

function search() {
	$("#where").val(" where emp_nm='" + $("#search_txt").val() + "'");
	setPage(1);
}

function search_department(){
	var big_department =  $("#big_department_cd option:selected").val();
	var middle_department =  $("#middle_department_cd option:selected").val();
	var small_department =  $("#small_department_cd option:selected").val();
	if(big_department != 0) var where = " where big_department_cd='" + big_department + "'";
	if(middle_department != 0) where += " and middle_department_cd='" + middle_department + "'";
	if(small_department != 0) where += " and small_department_cd='" + small_department + "'";
	$("#where").val(where);
	setPage(1);
}

// 거래처 리스트 가져오기
function getBigDepartment(){
	var tag = "<option value='0'>선택</option>";

	$.getJSON("../../ajax/base.php",{"mode":"getBigDepartment"},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#big_department_cd").html(tag);
		}
	);
}

function getMiddleDepartment(){
	var fid = $("#big_uid").val();
	var tag = "<option value='0'>선택</option>";

	$.getJSON("../../ajax/base.php",{"mode":"getMiddleDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}

			$("#middle_department_cd").html(tag);
		}
	);
}

function getSmallDepartment(){
	var fid = $("#middle_uid").val();
	var tag = "<option value='0'>선택</option>";

	$.getJSON("../../ajax/base.php",{"mode":"getSmallDepartment", "fid" : fid},
		function(json){
			if(json != null) {
				for(var i = 0 ; i < json.length ; i++){
					tag += "<option value='" + json[i].uid + "'>" + json[i].department_nm + "</option>";
				}
			}
			$("#small_department_cd").html(tag);
		}
	);
}

function postBigDepartment(uid){
	$("#big_uid").val(uid);
	getMiddleDepartment();
	$("#department_small_list tbody").html("");
}

function postMiddleDepartment(uid){
	$("#middle_uid").val(uid);
	getSmallDepartment();
}

function postSmallDepartment(uid){
	$("#small_uid").val(uid);
}
</script>

<div class="page-content">
	<div class="row">
		<div class="col-xs-12">
			<!-- PAGE CONTENT BEGINS -->
			<input type="hidden" name="where" id="where" value="<?=$where?>" />
			<input type="hidden" name="page" id="page" value="<?=$page?>" />
			<input type="hidden" name="big_uid" id="big_uid" />
			<input type="hidden" name="middle_uid" id="middle_uid" />
			<input type="hidden" name="small_uid" id="small_uid" />

			<div class="col-xs-8" style="float:right">
				<div class="input-group">						
					<input type="text" class="form-control search-query" placeholder="부서명" name="search_txt" id="search_txt" />
					<span class="input-group-btn">
						<button type="button" class="btn btn-purple btn-sm" onclick="search()">
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							Search
						</button>
					</span>
				</div>
			</div>

			<!-- 테이블 -->
			<table id="simple-table" class="table   table-hover">
				<tr>
					<th class="col-xs-4 center" style="background-color:#f1f1f1">부서</th>
				</tr>
<?
while($t = mysql_fetch_object($result)) {

?>
				<tr>
					<td><span style="padding-left:10px">△</span> <a href="javascript:void(0)" style="cursor:pointer" onclick="postDepartment('<?=$t->uid?>','<?=$t->department_nm?>')"><?=$t->department_nm?></a></td>
				</tr>			
					<?	
					$sql1 = "select * from erp_department_middle where fid=".$t->uid." order by seq desc";
					$result1 = query($sql1);	
					while($t1 = mysql_fetch_object($result1)) {
						?>
						<tr>
							<td><span style="padding-left:30px">▶</span> <a href="javascript:void(0)" style="cursor:pointer" onclick="postDepartment('<?=$t1->uid?>','<?=$t1->department_nm?>')"><?=$t1->department_nm?></a></td>
						</tr>			
						<?	
						$sql2 = "select * from erp_department_small where fid=".$t1->uid." order by seq desc";
						$result2 = query($sql2);	
						while($t2 = mysql_fetch_object($result2)) {
							?>
							<tr>
								<td><span style="padding-left:50px">▶</span> <a href="javascript:void(0)" style="cursor:pointer" onclick="postDepartment('<?=$t2->uid?>','<?=$t2->department_nm?>')"><?=$t2->department_nm?></a></td>
							</tr>			
						<?
						}
						?>	
					<?
					}
					?>
<?
}				
?>
<? if($total_num <= 0){?>
	<tr>
		<td class='center' colspan="3">등록된 데이터가 없습니다.
		</td>
	</tr>
<?}?>
			</table>
			<div class="center" id="paging_area"></div>
		</div>
	</div><!-- /.row -->

	<!-- submit -->
	<div class="clearfix form-actions center">
		<div class="col-md-12">
			<button class="btn btn-xs btn-info" type="button" onclick="self.close()">
				<i class="ace-icon fa fa-check bigger-110"></i>
				창닫기
			</button>
		</div>
	</div><!-- // submit -->
</div><!-- /.page-content -->


<?
require_once("../../assets/pfoot.php");
?>