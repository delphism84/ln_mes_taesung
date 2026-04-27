<?
mysql_connect("localhost","neblog","since1970","neblog") or die ("Connect Error");
mysql_select_db("neblog");

$json_data = $_POST['jsondata'];
$array = json_decode($json_data, true);

$dir = "testup/";
chmod("$dir", 0777);

$varName = "filename"; //이전 페이지에서 설정된 file 변수명
$allowExt = "jpg,gif,png,jpeg,JPG,GIF,PNG,doc,DOC,docx,Docx"; //업로드 가능한 확장자 (,)콤마로 구분

$prefix = time(); //파일명 앞에 자동으로 붙을 단어

$now = date("Y-m-d h:i:s");

if($_FILES[$varName][name] && $_FILES[$varName][error] == 0) {
	// $dir 폴더가 지정됐고, 사용가능 한지 검사
	if(!$dir) {
		echo "error";
		exit;
	}
	if(!is_writable($dir)) {
		echo "error";
		exit;
	}

	// php.ini 파일에 설정된 upload_max_filesize 값을 이용해서 업로드 파일이 용량을 초과했는지검사
	$allowSize = intval(substr(ini_get(upload_max_filesize),0,-1)) * 1024 * 1024;
	if($allowSize < $_FILES[$varName][size]) {
		echo "error";
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
			echo "error";
			exit;
		}

		// 파일명 생성 및 존재하는지 검사
		// $newfile = md5($prefix.$_FILES[$varName][name]).".".$ext;
		$newfile = $prefix.$_FILES[$varName][name];

		if(file_exists($dir.$newfile)) {
			echo "error";
			exit;
		}

		// $dir 에 파일 저장
		if(!move_uploaded_file($_FILES[$varName][tmp_name], $dir.$newfile)) {
			echo "error";
			exit;
		}
		
		if(!chmod($dir.$newfile,0707)) {
			echo "error";
			exit;
		}
	}
}

// 디비에 저장을 한다
foreach($array as $key => $value) {
	switch($key) {
		case "barcode" : $barcode = $value ; break;
		case "product_name" : $product_name = $value ; break;
		case "location" : $location = $value ; break;
		case "photo" : $photo = $value ; break;
		case "memo" : $memo = $value ; break;
		case "cmd" : $cmd = $value ; break;
		default : echo "error" ; break;
	}
}

$query = "select product_name from ots_product where barcode='$barcode'";
$t3 = @mysql_fetch_object(@mysql_query($query));
$product_name = $t3->product_name;

$query = "select uid,photo from ots_installation where barcode='$barcode'";
$res = @mysql_fetch_object(@mysql_query($query));
if($res->uid > 0 && $cmd != "update") {
	$return = "{ 'result' : 'already' , 'barcode' : '$barcode' }";
	echo $return;
	exit;
}

if($newfile == $res->photo) $newfile = $res->photo;
$now = date('Y-m-d H:i:s');

if($cmd == "insert") {
	$query = "
		insert into ots_installation (
			barcode,
			product_name,
			location,
			photo,
			memo,
			create_date
		) values (
			'$barcode',
			'$product_name',
			'$location',
			'$newfile',
			'$memo',
			'$now'
		)
	";
} else if($cmd == "update") {
	$query = "
		update ots_installation set 
			location='$location', photo='$newfile', memo='$memo', update_date='$now'
		where barcode='$barcode'
	";
}
//echo $query;
$result = mysql_query($query) or die ("Database Error");
if($result) {
	$return = "{ 'result' : 'success' , 'barcode' : '$barcode' }";
} else {
	$return = "{ 'result' : 'false' , 'barcode' : '$barcode' }";
}

echo $return;
?>
