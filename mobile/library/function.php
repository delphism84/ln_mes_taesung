<?
function query($sql)
{
	$result = @mysql_query($sql) or die(mysql_error());
	if(!$result) return false;
	else return $result;
}

function num_rows($sql)
{
	$result = query($sql);
	$num = @mysql_num_rows($result);
	return $num;
}

function fetch_array($sql)
{
	$num_row = num_rows($sql);
	if($num_row == 0)
	{
		return 0;
	} else {
		$result = query($sql);
		$i = 0;
		while($rows = @mysql_fetch_array($result))
		{
			$arydata[$i] = $rows;
			$i++;
		}

		return $arydata;
	}
}

function fetch_rows($sql)
{
	$num_row = num_rows($sql);
	if($num_row == 0)
	{
		return 0;
	} else {
		$result = query($sql);
		$i = 0;
		while($rows = @mysql_fetch_row($result))
		{
			$rowdata[$i] = $rows;
			$i++;
		}
		return $rowdata;
	}
}

function fetch_array_one($sql)
{
	$num_row = num_rows($sql);
	if($num_row == 0)
	{
		return 0;
	} else {
		$result = query($sql);
		$rows = @mysql_fetch_array($result);
		return $rows;
	}
}

function fetch_object($sql)
{
	$result = query($sql);
	$res = @mysql_fetch_object($result);
	return $res;
}

function upload2($file_id, $folder="", $types="") {
	if(!$_FILES[$file_id]['name']) return array('','No file specified');

	$file_title = $_FILES[$file_id]['name'];
	//Get file extension
	$ext_arr = split("\.",basename($file_title));
	$ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension

	//Not really uniqe - but for all practical reasons, it is
	$uniqer = substr(md5(uniqid(rand(),1)),0,5);
	$file_name = $uniqer . '_' . $file_title;//Get Unique Name

	$all_types = explode(",",strtolower($types));
	if($types) {
		if(in_array($ext,$all_types));
		else {
			$result = "'".$_FILES[$file_id]['name']."' is not a valid file."; //Show error if any.
			return array('',$result);
		}
	}

	//Where the file must be uploaded to
	if($folder) $folder .= '/';//Add a '/' at the end of the folder
	$uploadfile = $folder . $file_name;

	$result = '';
	//Move the file from the stored location to the new location
	if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
		$result = "Cannot upload the file '".$_FILES[$file_id]['name']."'"; //Show error if any.
		if(!file_exists($folder)) {
			$result .= " : Folder don't exist.";
		} elseif(!is_writable($folder)) {
			$result .= " : Folder not writable.";
		} elseif(!is_writable($uploadfile)) {
			$result .= " : File not writable.";
		}
		$file_name = '';
        
	} else {
		if(!$_FILES[$file_id]['size']) { //Check if the file is made
			@unlink($uploadfile);//Delete the Empty file
			$file_name = '';
			$result = "Empty file found - please use a valid file."; //Show the error message
		} else {
			chmod($uploadfile,0777);//Make it universally writable.
		}
	}

	return array($file_name,$result);
}

//' DB에 Insert
function convert_input($tag){
	$tag = str_ireplace("&","&amp;",$tag);
	$tag = str_ireplace('"',"&quot;",$tag);
	$tag = str_ireplace("'","&#039;",$tag);
	$tag = str_ireplace("<","&lt;",$tag);
	$tag = str_ireplace(">","&gt;",$tag);
	return $tag;
}

//' HTML로 OUT
function convert_output($CheckValue){
	$tag = str_ireplace("&","&amp;",$tag);
	$tag = str_ireplace('"',"&quot;",$tag);
	$tag = str_ireplace("'","&#039;",$tag);
	$tag = str_ireplace("<","&lt;",$tag);
	$tag = str_ireplace(">","&gt;",$tag);
	return $tag;
}
	
function show_message($msg){
	header('Content-Type: text/html; charset=UTF-8');
	echo "<script>";
	echo "alert('".$msg."');";
	echo "</script>";
}
    
function show_message_go($msg,$url){
	header('Content-Type: text/html; charset=UTF-8');
	echo "<script>";
	echo "alert('".$msg."');";
	echo "location.href='".$url."';";
	echo "</script>";
}

// 전화번호 등의 하이픈 붙이기
function add_hyphen($num){
	return preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/", "$1-$2-$3", $num);
}

function go_back($msg='', $url='') {
	header('Content-Type: text/html; charset=UTF-8');
	echo "<script>";
	if($msg) echo 'alert("'.$msg.'");';
	if($url) echo 'location.replace("'.$url.'");';
	else echo 'history.go(-1);';
	echo "</script>";
}
	
// 명칭명 가져오기
function convert_name($uid,$table){
	$query = "select name from ".$table." where uid=".$uid;
	$return = @mysql_fetch_object(mysql_query($query));
	return $return->name;
}

function upload3($folder,$attach){
	// 폴더생성
	@mkdir("$folder/", 0777);

	$dir = "$folder/"; //저장될 폴더 경로(끝에 '/'슬래시 꼭 붙여주세요...^^)
	chmod("$dir", 0777);

	$varName = $attach; //이전 페이지에서 설정된 file 변수명
	$allowExt = "jpg,gif,png,jpeg,JPG,GIF,PNG,doc,DOC,docx,Docx"; //업로드 가능한 확장자 (,)콤마로 구분

	$prefix = time(); //파일명 앞에 자동으로 붙을 단어

	$now = date("Y-m-d h:i:s");

	if($_FILES[$varName][name] && $_FILES[$varName][error] == 0) {
		// $dir 폴더가 지정됐고, 사용가능 한지 검사
		if(!$dir) {
			$core->go_back("업로드 폴더가 지정되지 않았습니다.");
			exit;
		}
		if(!is_writable($dir)) {
			$core->go_back("업로드 폴더 권한을 확인해 주세요.");
			exit;
		}

		// php.ini 파일에 설정된 upload_max_filesize 값을 이용해서 업로드 파일이 용량을 초과했는지검사
		$allowSize = intval(substr(ini_get(upload_max_filesize),0,-1)) * 1024 * 1024;
		if($allowSize < $_FILES[$varName][size]) {
			$core->go_back("파일 용량이 허용된 용량을 초과했습니다.");
			exit;
		}

		// 정상적인 방법으로 업로드 된 파일인지 검사 후 정상이면 파일 업로드 처리
		if(is_uploaded_file($_FILES[$varName][tmp_name])) {
			// 확장자 검사
			$ext = substr(strrchr($_FILES[$varName][name],"."),1);
			if($ext) {
				$allow = explode(",",$allowExt);
				if(is_array($allow)) $check = in_array($ext,$allow);
				else $check = ($ext == $allow) ? true : false;
			}
				
			if(!$ext || !$check) {
				$core->go_back("업로드 불가능한 확장자 입니다.");
				exit;
			}

			// 파일명 생성 및 존재하는지 검사
			// $newfile = md5($prefix.$_FILES[$varName][name]).".".$ext;
			$newfile = $prefix.$_FILES[$varName][name];

			if(file_exists($dir.$newfile)) {
				$core->go_back("같은이름의 화일이 있습니다. 화일명을 변경하고 업로드 하시기 바랍니다.");
				exit;
			}

			// $dir 에 파일 저장
			if(!move_uploaded_file($_FILES[$varName][tmp_name], $dir.$newfile)) {
				$core->go_back("파일 업로드에 실패했습니다.");
				exit;
			}
				
			if(!chmod($dir.$newfile,0707)) {
				$core->go_back("퍼미션변경에 실패했습니다.");
				exit;
			}
		}
	}

	return $newfile;
}

	
function upload($file_id, $folder="", $types="") {
	if(!$_FILES[$file_id]['name']) return array('','No file specified');

	$file_title = $_FILES[$file_id]['name'];
	//Get file extension
	$ext_arr = split("\.",basename($file_title));
	$ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension

	//Not really uniqe - but for all practical reasons, it is
	$uniqer = substr(md5(uniqid(rand(),1)),0,5);
	$file_name = $uniqer . '_' . $file_title;//Get Unique Name

	$all_types = explode(",",strtolower($types));
	if($types) {
		if(in_array($ext,$all_types));
		else {
			$result = "'".$_FILES[$file_id]['name']."' is not a valid file."; //Show error if any.
			return array('',$result);
		}
	}

	//Where the file must be uploaded to
	if($folder) $folder .= '/';//Add a '/' at the end of the folder
	$uploadfile = $folder . $file_name;

	$result = '';
	//Move the file from the stored location to the new location
	if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
		$result = "Cannot upload the file '".$_FILES[$file_id]['name']."'"; //Show error if any.
		if(!file_exists($folder)) {
			$result .= " : Folder don't exist.";
		} elseif(!is_writable($folder)) {
			$result .= " : Folder not writable.";
		} elseif(!is_writable($uploadfile)) {
			$result .= " : File not writable.";
		}
		$file_name = '';
        
	} else {
		if(!$_FILES[$file_id]['size']) { //Check if the file is made
			@unlink($uploadfile);//Delete the Empty file
			$file_name = '';
			$result = "Empty file found - please use a valid file."; //Show the error message
		} else {
			chmod($uploadfile,0777);//Make it universally writable.
		}
	}

	return array($file_name,$result);
}

// 작업공정 변환
function convert_process($process) {
	$query = "select * from process where uid=".$process;
	$t = @mysql_fetch_object(mysql_query($query));

	if($t->uid) {
		return $t->name;
	} else {
		return "미지정";
	}
}

function convert_project_type($type){
	switch($type) {
		case "1" : return "판매"; break;
		case "2" : return "구매"; break;
		case "3" : return "생산"; break;
		case "4" : return "개발"; break;
	}
}

//  현재와 비교할 날짜를 가지고 색상을 반환한다.
function compareCurrentDate($dt){
	$work_dt = explode("-",substr($dt,0,10));
	$work_time = mktime(0,0,0,$work_dt[1],$work_dt[2],$work_dt[0]);
	$current = date("Y-m-d");
	$current_dt = explode("-",substr($current,0,10));
	$current_time = mktime(0,0,0,$current_dt[1],$current_dt[2],$current_dt[0]);
	if($work_time < $current_time) $color = "style='background-color:#febbee'";
	else $color = "";

	return $color;
}

// 공정명 반환
function getProcessName($code) {
	$sql = "select process_nm from erp_process where process_cd='".$code."'";
	$return = fetch_object($sql);

	return $return->process_nm;
}

// 기계명 반환
function getMachineNm($code) {
	$sql = "select machine_nm from erp_machine where uid=".$code;
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->machine_nm;
}

function getEmpNm($code) {
	$sql = "select emp_nm from erp_employee where emp_id='".$code."'";
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->emp_nm;
}

function getWarehouseName($code) {
	$sql = "select warehouse_nm from erp_warehouse where warehouse_cd='".$code."'";
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->warehouse_nm;
}

function getWarehouseCode($code) {
	$sql = "select warehouse_cd from erp_warehouse where warehouse_nm='".$code."'";
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->warehouse_cd;
}

function getAccountCode($code) {
	$sql = "select account_cd from erp_account where account_nm='".$code."'";
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->account_cd;
}

function getAccountName($code) {
	$sql = "select account_nm from erp_account where account_cd='".$code."'";
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->account_nm;
}

function getBigDepartmentCd($name) {
	$sql = "select uid from erp_department_big where department_nm='".$name."'";
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->uid;
}

function getMiddleDepartmentCd($name) {
	$sql = "select uid from erp_department_middle where department_nm='".$name."'";
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->uid;
}

function getSmallDepartmentCd($name) {
	$sql = "select uid from erp_department_small where department_nm='".$name."'";
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->uid;
}

function getPositionCd($name) {
	$sql = "select uid from erp_position where position_nm='".$name."'";
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->uid;
}

function getItemName($code) {
	$sql = "select item_nm from erp_item where item_cd='".$code."'";
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->item_nm;
}

function getCorpNm() {
	$sql = "select corp_nm from erp_info where uid=1";
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->corp_nm;
}

function getBigDepartmentName($cd) {
	$sql = "select department_nm from erp_department_big where uid=".$cd;
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->department_nm;
}

function getMiddleDepartmentName($cd) {
	$sql = "select department_nm from erp_department_middle where uid=".$cd;
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->department_nm;
}

function getSmallDepartmentName($cd) {
	$sql = "select department_nm from erp_department_small where uid=".$cd;
	$return = @mysql_fetch_object(mysql_query($sql));

	return $return->department_nm;
}

function findOrderItem() {

}

function getVatType($code) {
		switch ($code) {
		case 1:
			$text ="세금계산서";
			break;
		case 2:
			$text ="영세율";
			break;
		case 3:
			$text ="계산서";
			break;
		case 4:
			$text ="소매매출";
			break;
		case 5:
			$text ="수출";
			break;
		case 6:
			$text ="카드매출";
			break;
		case 7:
			$text ="계산서(고정자산)";
			break;
		case 8:
			$text ="세.계(고정자산)";
			break;
		case 9:
			$text ="소매(면세)";
			break;
		case 10:
			$text ="카드매출(면세)";
			break;
		case 11:
			$text ="현금영수증(면세)";
			break;
		case 12:
			$text ="현금영수증";
			break;
		case 13:
			$text ="매입자발행세금계산서";
			break;
		case 14:
			$text ="영세율(기타)";
			break;
		case 15:
			$text ="기타매출";
			break;
		default:
			$text ="세금계산서";
		}

		return $text;
	}

function GetInTypeEctaxFlag($code) {
		switch ($code) {
		case 1:
			$text ="종이(세금)계산서";
			break;
		case 2:
			$text ="전자(세금)계산서-신규";
			break;
		case 3:
			$text ="기재사항착오정정";
			break;
		case 4:
			$text ="공급가액변동";
			break;
		case 5:
			$text ="환입";
			break;
		case 6:
			$text ="계약의해제";
			break;
		case 7:
			$text ="내국신용장개설";
			break;
		case 7:
			$text ="착오에의한이중발행";
			break;
		default:
			$text ="세금계산서";
		}

		return $text;
}

// 구매요청


?>