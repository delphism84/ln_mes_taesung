<?
extract($_POST);
extract($_GET);

$title = "사원";

require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");

if ( ! isset ( $where ) ) $where = "";

$table = "erp_employee";
$block = 10;

$sql = "select * from ".$table.$where;
$total_num = num_rows($sql);

$page = (is_numeric($page)) ? $page : 1; 

$sql = "select * from ".$table.$where." order by uid desc  limit ".($page-1)*$block.", ".$block;
$result = query($sql);
?>

<script>
$(document).ready(function(){
	var table = "erp_employee";
	var where = $("#where").val();
	var rpp = 10;
	var adjacents = 4;

	getPaging(table,where,rpp,adjacents);

	getBigDepartment();
});

function postEmployee(emp_id,emp_nm) {
	window.parent.$("#department_cd").val(emp_id);
	window.parent.$("#department_nm").val(emp_nm);
	window.parent.$("#<?=$dialogID?>").modal( 'hide' );
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

			<div class="col-xs-7" style="float:left">
				<select name="big_department_cd" id="big_department_cd" onchange="postBigDepartment(this.value)"><option value="0">선택</option></select>
				<select name="middle_department_cd" id="middle_department_cd" onchange="postMiddleDepartment(this.value)"><option value="0">선택</option></select>
				<select name="small_department_cd" id="small_department_cd" onchange="postSmallDepartment(this.value)"><option value="0">선택</option></select>
				<input type="button" class="btn btn-xs" value="검색" onclick="search_department()"/>
			</div>
			<div class="col-xs-5" style="float:right">
				<div class="input-group">						
					<input type="text" class="form-control search-query" placeholder="사원명" name="search_txt" id="search_txt" />
					<span class="input-group-btn">
						<button type="button" class="btn btn-purple btn-sm" onclick="search()">
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							Search
						</button>
					</span>
				</div>
			</div>

			<!-- 테이블 -->
			<table id="simple-table" class="table  table-bordered table-hover">
				<tr>
					<th class="col-xs-2 center" style="background-color:#f1f1f1">부서</th>
					<th class="col-xs-6 center" style="background-color:#f1f1f1">사원명</th>
				</tr>
<?
while($t = mysql_fetch_object($result)) {
?>
				<tr>
					<td class='center'>
						<?
						if(!empty($t->big_department_nm)) echo $t->big_department_nm;
						if(!empty($t->middle_department_nm)) echo "-".$t->middle_department_nm;
						if(!empty($t->small_department_nm)) echo "-".$t->small_department_nm;
						?>
					</td>
					<td class='center'><span style="cursor:pointer" onclick="postEmployee('<?=$t->emp_id?>','<?=$t->emp_nm?>')"><?=$t->emp_nm?></span></td>
				</tr>			
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
			<button class="btn btn-xs btn-info" type="button" onclick="window.parent.$('#<?=$dialogID?>').modal( 'hide' );">
				<i class="ace-icon fa fa-check bigger-110"></i>
				창닫기
			</button>
		</div>
	</div><!-- // submit -->
</div><!-- /.page-content -->


<?
require_once("../../assets/pfoot.php");
?>