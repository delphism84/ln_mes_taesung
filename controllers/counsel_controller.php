<?
class CounselController {
	/*

//$core->query("select * from customer");
// 기등록자 검사 필요
$now = date("Y-m-d h:i:s");

//var_dump($_POST);
//echo $fid;

$data = array(
	"table" => "counsel",
	"id" => $_SESSION['id'],
	"fid" => $fid,
	"counsel_date" => $counsel_date,
	"counsel_time" => $counsel_time.":00",
	"name" => $name,
	"process" => $process,
	"contact_type" => $contact_type,
	"response" => $response,
	"counsel" => $counsel,
	"next_counsel_date" => $next_counsel_date,
	"next_counsel_time" => $next_counsel_time.":00",
	"next_process" => $next_process,
	"reg_date" => $now
);

//var_dump($data);

$result = $core->insert($data);


// 다음 약속시간을 일정에 등록한다
$data = array(
	"table" => "schedule",
	"fid" => $fid,
	"id" => $_SESSION['id'],
	"promise_div"=>$promise_div,
	"place"=>"",
	"importance"=>$importance,
	"name" => $name,
	"promise_date" => $next_counsel_date,
	"promise_time" => $next_counsel_time.":00",
	"memo" => $next_process,
	"reg_date" => $now
);

$result = $core->insert($data);

if($result) echo "success";
*/

	// 거래처 리스트
	public function counsel_list(){
		require_once ('views/counsel/counsel_list.php');
	}
	
	// 거래처 등록
	public function counsel_regist(){
		require_once ("views/counsel/counsel_regist.php");
	}

	public function counsel_regist_exe(){
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
		if($result) require_once ("views/counsel/counsel_list.php");
	}

	public function counsel_view(){
		$t = Counsel::viewCounsel($_GET['uid']);
		require_once('views/counsel/counsel_view.php');
	}

	public function counsel_update_exe(){
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
		if($result) require_once ("views/counsel/counsel_list.php");
	}
}
?>