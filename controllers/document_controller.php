<?
class DocumentController {
	/*

// 폴더생성
@mkdir("uploads/".$_SESSION['id']."/", 0777);

$dir = "uploads/".$_SESSION['id']."/"; //저장될 폴더 경로(끝에 '/'슬래시 꼭 붙여주세요...^^)
chmod("$dir", 0777);

$varName = "upload_file"; //이전 페이지에서 설정된 file 변수명
$allowExt = "jpg,gif,png,jpeg,JPG,GIF,PNG,doc,DOC,docx,Docx"; //업로드 가능한 확장자 (,)콤마로 구분

$prefix = time(); //파일명 앞에 자동으로 붙을 단어

$now = date("Y-m-d h:i:s");

function goBack($msg='', $url='') {
	echo "<script>";
	if($msg) echo 'alert("'.$msg.'");';
	if($url) echo 'location.replace("'.$url.'");';
	else echo 'history.go(-1);';
	echo "</script>";
}

 

if($_FILES[$varName][name] && $_FILES[$varName][error] == 0) {
	// $dir 폴더가 지정됐고, 사용가능 한지 검사
	if(!$dir) {
		goBack("업로드 폴더가 지정되지 않았습니다.");
		exit;
	}
	if(!is_writable($dir)) {
		goBack("업로드 폴더 권한을 확인해 주세요.");
		exit;
	}

	// php.ini 파일에 설정된 upload_max_filesize 값을 이용해서 업로드 파일이 용량을 초과했는지검사
	$allowSize = intval(substr(ini_get(upload_max_filesize),0,-1)) * 1024 * 1024;
	if($allowSize < $_FILES[$varName][size]) {
		goBack("파일 용량이 허용된 용량을 초과했습니다.");
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
			goBack("업로드 불가능한 확장자 입니다.");
			exit;
		}

		// 파일명 생성 및 존재하는지 검사
		// $newfile = md5($prefix.$_FILES[$varName][name]).".".$ext;
		$newfile = $prefix.$_FILES[$varName][name];

		if(file_exists($dir.$newfile)) {
			goBack("같은이름의 화일이 있습니다. 화일명을 변경하고 업로드 하시기 바랍니다.");
			exit;
		}

		// $dir 에 파일 저장
		if(!move_uploaded_file($_FILES[$varName][tmp_name], $dir.$newfile)) {
			goBack("파일 업로드에 실패했습니다.");
			exit;
		}
		
		if(!chmod($dir.$newfile,0707)) {
			goBack("퍼미션변경에 실패했습니다.");
			exit;
		}
	}
}
 



if(!$uid) {
	$data = array(
		"table" => "data",
		"id" => $_SESSION['id'],
		"title" => $title,
		"upload_file" => $newfile,
		"real_file" => $_FILES[$varName]['name'],
		"reg_date" => $now
	);

	$core->insert($data);

	goBack("자료를 등록하였습니다.");
} else {
	$query = "select * from data where uid=".$uid;
	$t = mysql_fetch_object(mysql_query($query));

	if($newfile == "") {
		$newfile = $t->upload_file;
		$real_file = $t->real_file;
	} else {
		$newfile = $newfile;
		$real_file = $_FILES[$varName]['name'];
	}
	
	$data = array(
		"table" => "data",
		"where" => "uid=".$uid,
		"id" => $_SESSION['id'],
		"title" => $title,
		"upload_file" => $newfile,
		"real_file" => $real_file,
		"reg_date" => $now
	);

	goBack("자료를 등록하였습니다.");
}
*/
	// 거래처 리스트
	public function document_list(){
		require_once ('views/document/document_list.php');
	}
	
	// 거래처 등록
	public function document_regist(){
		require_once ("views/document/document_regist.php");
	}

	public function document_regist_exe(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "customer",
			"customer_id" => $_POST['customer_id'],
			"customer_pwd" => $_POST['customer_pwd'],
			"name" => $_POST['name'],
			"account_type" => $_POST['account_type'],
			"owner" => $_POST['owner'],
			"business_number" => $_POST['business_number'],
			"business_type" => $_POST['business_type'],
			"business_item" => $_POST['business_item'],
			"zipcode" => $_POST['zipcode'],
			"address1" => $_POST['address1'],
			"address2" => $_POST['address2'],
			"telephone" => $_POST['telephone'],
			"fax" => $_POST['fax'],
			"email" => $_POST['email'],
			"product" => $_POST['product'],
			"id" => '',
			"reg_date" => $now,
			"timestamp" => time()
		);

		$customer = new Customer;
		$result = $customer->registCustomer($data);
		if($result) require_once ("views/document/document_list.php");
	}

	public function document_view(){
		$t = Customer::viewCustomer($_GET['uid']);
		require_once('views/document/document_view.php');
	}

	public function document_update_exe(){
		$now = date("Y-m-d H:i:s");
		$data = array(
			"table" => "customer",
			"where" => "uid=".$_POST['uid'],
			"customer_id" => $_POST['customer_id'],
			"customer_pwd" => $_POST['customer_pwd'],
			"name" => $_POST['name'],
			"account_type" => $_POST['account_type'],
			"owner" => $_POST['owner'],
			"business_number" => $_POST['business_number'],
			"business_type" => $_POST['business_type'],
			"business_item" => $_POST['business_item'],
			"zipcode" => $_POST['zipcode'],
			"address1" => $_POST['address1'],
			"address2" => $_POST['address2'],
			"telephone" => $_POST['telephone'],
			"fax" => $_POST['fax'],
			"email" => $_POST['email'],
			"product" => $_POST['product'],
			"id" => '',
			"reg_date" => $now,
			"timestamp" => time()
		);

		$customer = new Customer;
		$result = $customer->updateCustomer($data);
		if($result) require_once ("views/document/document_list.php");
	}
}
?>