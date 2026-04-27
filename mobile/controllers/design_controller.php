<?
require_once("models/dba.php");

class Design extends Dba {
	private $tpl;

/*	
	public function sample() {
		$this->tpl = 
<<<EOF

EOF;
		return $this->tpl;
	}
*/	

	public function headNavi($controller, $action) {
		$myfile = fopen("assets/menual/base/inputPageItem.php", "r") or die("Unable to open file!");
		$a = fread($myfile,filesize("assets/menual/base/inputPageItem.php"));
		
		$this->tpl =
<<<EOF
			<div class="breadcrumbs ace-save-state" id="breadcrumbs"style="background-color:#fff;border:none;">
				<ul class="breadcrumb">
					<li>
						<i class="ace-icon fa fa-home home-icon"></i>
						<a href="#">Home</a>
					</li>
					<li>
						<a href="#">$controller</a>
					</li>
					<li class="active last">
						$action			
					</li>				
				</ul>
			</div>
EOF;
		echo $this->tpl;

		fclose($myfile);
	}

	public function navi($navi, $advice) {
		$this->tpl = 
<<<EOF
			<div style="float:left">
				<h2 style='color:#3986d9'>
					$navi
					<!--<small>
						<i class="ace-icon fa fa-angle-double-right"></i>
						$advice
					</small>-->
				</h2>
			</div>

EOF;

		echo $this->tpl;
	}

	public function popTitle($title) {
		$this->tpl = 
<<<EOF
			<div class="widget-box widget-color-orange collapsed" id="widget-box-3">
				<div class="widget-header widget-header-small">
					<h5 class="widget-title">
					<!--<i class="ace-icon fa fa-sort"></i>-->
						<span style="font-weight:bold"><i class="ace-icon fa fa-caret-right red"></i> $title</span>
					</h5>
				</div>
			</div>
EOF;

		echo $this->tpl;
	}

	public function th($txt, $color = null, $style = null) {
		if($color == "") $color = "blue";
		$this->tpl = 
<<<EOF
			<th class='' style="background-color:#f1f1f1; vertical-align:middle; $style"><i class="ace-icon fa fa-caret-right $color"></i> $txt</th>
EOF;
		echo $this->tpl;
	}
	
	// 리스트 화면에서 체크박스가 있는 테이블을 생성
	public function table($id, $txt, $del = null) {
		$this->tpl =
<<<EOF
			<div>
				<table id="$id" class="table table-bordered">
					<thead class="thin-border-bottom">
						<tr>
EOF;
		if($del == "") {
			//if($_SESSION['login_level'] >= 99) {
				$this->tpl .= 
<<<EOF
						<th class="detail-col center">
							<label class="pos-rel">
								<input type="checkbox" class="ace" id="checkedAll" />
								<span class="lbl"></span>
							</label>
						</th>
EOF;
			//}
		}

		$txt = explode(",",$txt);

		for($i = 0 ; $i < sizeof($txt) ; $i++) {
			$arr = explode("=>",$txt[$i]);
			$this->tpl .= 
<<<EOF
					<th class="col-xs-$arr[1]"><i class="ace-icon fa fa-caret-right blue"></i> $arr[0]</th>
EOF;
		}
		
		$this->tpl .=
<<<EOF
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
EOF;

		echo $this->tpl;
	}

	// 리스트 화면에서 체크박스가 있는 테이블을 생성
	public function table2($id, $txt, $del = null) {
		$this->tpl =
<<<EOF
			<div>
				<table id="$id" class="table table-bordered">
					<thead class="thin-border-bottom">
						<tr>
EOF;
		if($del == "") {
			if($_SESSION['login_level'] >= 99) {
				$this->tpl .= 
<<<EOF
						<th class="detail-col center">
							<label class="pos-rel">
								<input type="checkbox" class="ace" id="checkedAll2" />
								<span class="lbl"></span>
							</label>
						</th>
EOF;
			}
		}

		$txt = explode(",",$txt);

		for($i = 0 ; $i < sizeof($txt) ; $i++) {
			$arr = explode("=>",$txt[$i]);
			$this->tpl .= 
<<<EOF
					<th class="col-xs-$arr[1]"><i class="ace-icon fa fa-caret-right blue"></i> $arr[0]</th>
EOF;
		}
		
		$this->tpl .=
<<<EOF
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
EOF;

		echo $this->tpl;
	}

	// 리스트 화면에서 체크박스가 있는 테이블을 생성
	public function table3($id, $txt, $del = null) {
		$this->tpl =
<<<EOF
			<div>
				<table id="$id" class="table table-bordered">
					<thead class="thin-border-bottom">
						<tr>
EOF;
		if($del == "") {
			if($_SESSION['login_level'] >= 99) {
				$this->tpl .= 
<<<EOF
						<th class="detail-col center">
							<label class="pos-rel">
								<input type="checkbox" class="ace" id="checkedAll3" />
								<span class="lbl"></span>
							</label>
						</th>
EOF;
			}
		}

		$txt = explode(",",$txt);

		for($i = 0 ; $i < sizeof($txt) ; $i++) {
			$arr = explode("=>",$txt[$i]);
			$this->tpl .= 
<<<EOF
					<th class="col-xs-$arr[1]"><i class="ace-icon fa fa-caret-right blue"></i> $arr[0]</th>
EOF;
		}
		
		$this->tpl .=
<<<EOF
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
EOF;

		echo $this->tpl;
	}

	public function noCheckTable($id, $txt, $style = null) {
		$this->tpl =
<<<EOF
			<div style="$style">
				<table id="$id" class="table table-bordered table-striped table-hover">
					<thead style='border-bottom:1px solid #ccc'>
						<tr>
EOF;

		$txt = explode(",",$txt);

		for($i = 0 ; $i < sizeof($txt) ; $i++) {
			$arr = explode("=>",$txt[$i]);
			$this->tpl .= 
<<<EOF
				<th class="col-xs-$arr[1]"><i class="ace-icon fa fa-caret-right blue"></i> $arr[0]</th>
EOF;
		}
		
		$this->tpl .=
<<<EOF
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
EOF;

		echo $this->tpl;
	}

	public function per($onchange, $style = null, $increase = 10, $cnt = 5) {
		$this->tpl = "<select id='per' onchange='".$onchange."' style='height:35px; width:33.3333%;".$style.">";
		$val = 0;
		for($i = 0 ; $i <= $cnt ; $i++) {
			$this->tpl .= "<option value='".$val."'>".$val." 개씩 보기</option>";
			$val = $val + $increase;
		}
		$this->tpl .= "<option value='all'>전체 보기</option></select>";

		echo $this->tpl;
	}

	public function periodSearch($onclick, $txt) {
		$end = date("Y-m-d");
		$first = date("Y-m-d", strtotime("-1 month", time())); // 전 달 

		$this->tpl = 
<<<EOF
			<div style="float:left; margin-left:5px">
				<span class="input-icon input-icon-right">
					<div class="input-group">
						<input class="date-picker form-control" name="start_dt" id="start_dt" type="text" style="width:100px" value='$first' data-date-format="yyyy-mm-dd" />
						<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
						</span>
					</div>
				</span>
			</div>
			<div style="float:left">&nbsp;~&nbsp;</div>
			<div style="float:left">
				<span class="input-icon input-icon-right">
					<div class="input-group ">
						<input class="date-picker form-control" name="end_dt" id="end_dt" type="text" style="width:100px" value='$end' data-date-format="yyyy-mm-dd" />
						<span class="input-group-addon">
							<i class="fa fa-calendar bigger-110"></i>
						</span>
					</div>
				</span>
				<span class="input-icon input-icon-right">
					<div class="input-group">
						<button type="button" class="btn btn-purple btn-sm form-control" onclick="$onclick" >
							<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
							$txt
						</button>
					</div>
				</span>
			</div>
EOF;
		echo $this->tpl;
	}
	
	// 화면 가운데 선택삭제 버튼만 있는 경우
	public function centerDelBtn() {
		if($_SESSION['login_level'] >= 99) {
			$this->tpl = 
<<<EOF
				<div class="col-md-12 center" style="margin-top:20px">
					<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirm-delete">
						<i class="ace-icon fa fa-undo"></i>
						선택삭제
					</button>
				</div>
EOF;
			echo $this->tpl;
		}
	}

	public function registBtn($txt, $controller, $action) {
		$this->tpl =
<<<EOF
			<div class="col-md-12 center" style="margin-top:20px">
				<button class="btn btn-info" type="button" onclick="formSubmit()">
					<i class="ace-icon fa fa-check bigger-110"></i>
					$txt
				</button>
				<button class="btn" type="reset" onclick="location.href = 'index.php?controller=$controller&action=$action' ">
					<i class="ace-icon fa fa-undo bigger-110"></i>
					돌아가기
				</button>
			</div>
EOF;
		echo $this->tpl;
	}

	public function onlyRegistBtn($txt) {
		$this->tpl =
<<<EOF
			<div class="col-md-12 center">
				<button class="btn btn-info" type="button" onclick="formSubmit()">
					<i class="ace-icon fa fa-check bigger-110"></i>
					$txt
				</button>
			</div>
EOF;
		echo $this->tpl;
	}

	public function pagingBtn($txt = null, $controller = null, $action = null, $delete_table = null, $no) {
		$this->tpl =
<<<EOF
			<div class="col-md-12" style="margin-top:20px">
				<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
				<div class="col-xs-6 right" style="text-align:right">
					<button class="btn btn-info" type="button" onclick="location.href = 'index.php?controller=$controller&action=$action' ">
						<i class="ace-icon fa fa-check"></i>
						$txt
					</button>
EOF;

		if($_SESSION['login_level'] >= 99) {
			$this->tpl .=
<<<EOF
				<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#confirm-delete"">
					<i class="ace-icon fa fa-undo"></i>
					선택삭제
				</button>
EOF;
		}
		
		$this->tpl .= 
<<<EOF
				</div>
			</div>
EOF;
		echo $this->tpl;
	}

	public function pagingDelBtn($txt = null, $controller = null, $action = null, $delete_table = null, $no) {
		$this->tpl =
<<<EOF
			<div class="col-md-12" style="margin-top:20px">
				<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
				<div class="col-xs-6 right" style="text-align:right">
EOF;

		if($_SESSION['login_level'] >= 99) {
			$this->tpl .=
<<<EOF
				<button class="btn btn-danger" type="button" onclick="deleteSelect($no, '$delete_table')">
					<i class="ace-icon fa fa-undo"></i>
					선택삭제
				</button>
EOF;
		}
		
		$this->tpl .= 
<<<EOF
				</div>
			</div>
EOF;
		echo $this->tpl;
	}

	public function pagingCloseBtn($txt = null, $controller = null, $action = null, $delete_table = null, $no) {
		$this->tpl =
<<<EOF
			<div class="col-xs-12" style="margin-top:20px">
				<div class="col-xs-6" style="text-align:left"><span id="paging_area"></span></div>
				<div class="col-xs-6 right" style="text-align:right">
					<button class="btn btn-xs btn-danger" type="button" onclick="javascript:self.close()">
						<i class="ace-icon fa fa-undo"></i>
						창닫기
					</button>
				</div>
			</div>
EOF;
		
		echo $this->tpl;
	}

	public function hidden($where = null) {
		$this->tpl =
<<<EOF
			<input type="hidden" name="page" id="page" value="1" />
			<input type="hidden" name="where" id="where" value="$where" />
			<input type="hidden" name="check_uids" id="check_uids" />
			<input type="hidden" name="check_uids2" id="check_uids2" />
			<input type="hidden" name="check_uids3" id="check_uids3" />
EOF;
		echo $this->tpl;
	}

	public function search($text = null) {
		$this->tpl = 
<<<EOF
		<div class="input-group">						
			<input type="text" class="form-control search-query" placeholder="$text" name="search_txt" id="search_txt" />
			<span class="input-group-btn">
				<button type="button" class="btn btn-purple btn-sm" onclick="search()">
					<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>$text</button>
			</span>
		</div>
EOF;
		echo $this->tpl;
	}

	public function selectBox($name, $id, $txt, $check = null) {
		$this->tpl = 
<<<EOF
			<select name="$name" id="$id">
EOF;

		$txt_array = explode(",",$txt);
		for($i = 0 ; $i <= sizeof($txt_array) ; $i++) {
			if($txt_array == $check) $sel = "selected";
			else $sel = "";
			$this->tpl .= 
<<<EOF
				<option value="$txt_array[$i]" $sel>$txt_array[$i]</option>
EOF;
		}

		$this->tpl .= 
<<<EOF
			</select>
EOF;

		echo $this->tpl;
	}
	//col-xs-12 div안에 지움
	public function paging() {
		$this->tpl =
<<<EOF
			<div class="center" style="margin-bottom:20px;font-size:20px;"><span id="paging_area"></span></div>
EOF;
		echo $this->tpl;
	}

	public function alertModal() {
		$this->tpl = 
<<<EOF
			<div class="modal fade" id="alertModal" data-keyboard="false" style='z-index:99999'>
				<div class="modal-dialog">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header" style="background:red">
							<span style="font-weight:bold; color:#fff; font-size:14pt">경고</span>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body" style="height:70px; vertical-align:middle">
							<div id="message" style="color:black; text-align:center;"></div>
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<div style="float:right"><button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button></div>
						</div>
					</div>
				</div>
			</div>
EOF;
		echo $this->tpl;
	}

	public function confirmModal() {
		$this->tpl = 
<<<EOF
			<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">

						<div class="modal-header" style="background-color:red">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel" style="color:white">삭제 확인</h4>
						</div>

						<div class="modal-body">
							<p>선택하신 데이터를 삭제하시겠습니까?</p>
							<p>다른 데이터와 연동된 데이터는 삭제가 되지 않습니다</p>
							<p class="debug-url"></p>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
							<a class="btn btn-danger btn-ok">삭제</a>
						</div>
					</div>
				</div>
			</div>
EOF;
		echo $this->tpl;
	}

	public function createDbSelectBox($table, $field, $name, $onchange = null, $check = null, $class = null, $style = null) {
		$sql = "show columns from ".$table." like 'seq'";
		$this->sub_query($sql);
		if($this->sub_get_rows() > 0) {
			$sql = "select * from ".$table." order by seq asc";
		} else {
			$sql = "select * from ".$table." order by uid desc";
		}
		//echo $sql;
		$this->sub_query($sql);

		if(!empty($onchange)) $onchange = "onchange='".$onchange."(this.value)'";

		$tag = "<select class='".$class."' name='".$name."' id='".$name."' ".$onchange." style='height:35px;".$style."'>";
		$tag .= "<option value='0'>==선택==</option>";
		while($t = $this->sub_fetch()) {
			if($t->uid == $check) $sel = "selected"; else $sel = "";
			$tag .= "<option value='".$t->uid."' ".$sel.">".$t->{$field}."</option>";
		}

		$tag .= "</select>";

		echo $tag;
	}

	// 라디오박스 만들기
	public function createDbRadio($table, $field, $name, $onclick = null, $check = null) {
		$sql = "show columns from ".$table." like 'seq'";
		$this->sub_query($sql);
		if($this->sub_get_rows() > 0) {
			$sql = "select * from ".$table." order by seq asc";
		} else {
			$sql = "select * from ".$table." order by uid desc";
		}
		//echo $sql;
		$this->sub_query($sql);

		if(!empty($onclick)) $onclick = "onclick='".$onclick."()'";
		
		$i = 0;
		while($t = $this->sub_fetch()) {
			if(empty($check) && $i == 0) {
				$chk = "checked"; 
			} else {
				$chk = "";
			}

			$tag .= "<input type='radio' class='ace' name='".$name."' id='".$name."' value='".$t->uid."' ".$onclick." ".$chk." /><span class='lbl'> ".$t->{$field}."</span>&nbsp;";
			$i++;
		}

		echo $tag;
	}

	// select box 만들기
	public function createSelectBox($name, $onchange = null) {
		if(!empty($onchange)) $onchange = "onchange='".$onchange."(this.value)";

		$tag = "<select name='".$name."' id='".$name."' ".$onchange.">";
		$tag .= "</select>";

		echo $tag;
	}
}
?>