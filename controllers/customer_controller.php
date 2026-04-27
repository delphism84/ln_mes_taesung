<?
class CustomerController {
	/*

function addHyphen($num){
	return preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/", "$1-$2-$3", $num);
}

if($_SESSION['state'] == 0) {
	$query = "select count(uid) as cnt from customer where id='".$_SESSION['id']."'";
	$result = mysql_fetch_object(mysql_query($query));
	if($result->cnt >= 100) {
		echo "limit";	exit;
	}
}

//$core->query("select * from customer");
// 기등록자 검사 필요
$now = date("Y-m-d h:i:s");

//var_dump($_POST);

$mobile = addHyphen($mobile);
$telephone = addHyphen($telephone);
$company_telephone = addHyphen($company_telephone);
$company_fax = addHyphen($company_fax);

if($uid != "") { // 고객정보 수정
	$data = array(
		"table" => "customer",
		"where" => "uid=".$uid,
		"gid" => $gid,
		"id" => $_SESSION['id'],
		"sexual" => $sexual,
		"name" => $name,
		"closeness" => $closeness,
		"company" => $company,
		"department" => $department,
		"position" => $position,
		"job" => $job,
		"telephone" => $telephone,
		"mobile" => $mobile,
		"email" => $email,
		"keyman" => $keyman_uid,
		"zipcode" => $zipcode,
		"address1" => $address1,
		"address2" => $address2,
		"relation" => $relation,
		"company_telephone" => $company_telephone,
		"company_fax" => $company_fax,
		"company_zipcode" => $company_zipcode,
		"company_address1" => $company_address1,
		"company_address2" => $company_address2,
		"receive_email" => $receive_email,
		"receive_sms" => $receive_sms,
		"area" => $area,
		"school" => $school,
		"blog" => $blog,
		"sns" => $sns,
		"interest" => $interest,
		"hobby" => $hobby,
		"special" => $special,
		"pre_company" => $pre_company,
		"smoking" => $smoking,
		"religion" => $religion,
		"blood_group" => $blood_group,
		"anniversary1" => $anniversary1,
		"anniversary_date1" => $anniversary_date1,
		"anniversary2" => $anniversary2,
		"anniversary_date2" => $anniversary_date2,
		"anniversary3" => $anniversary3,
		"anniversary_date3" => $anniversary_date3,
		"anniversary4" => $anniversary4,
		"anniversary_date4" => $anniversary_date4,
		"anniversary5" => $anniversary5,
		"anniversary_date5" => $anniversary_date5,
		"memo" => $memo,
		"mod_date" => $now
	);
	
	//var_dump($data);

	$result = $core->update($data);

	$fid = mysql_insert_id();
	
	$anniversary_date = array($anniversary_date1,$anniversary_date2,$anniversary_date3,$anniversary_date4,$anniversary_date5);
	$anniversary = array($anniversary1,$anniversary2,$anniversary3,$anniversary4,$anniversary5);
	
	if(sizeof($anniversary) > 0) {
		
		for($i = 0 ; $i < 5 ; $i++){
			if($anniversary_date[$i] != "") {
				$query = "select * from schedule where fid=".$uid." and id='".$_SESSION['id']."' and promise_date='".$anniversary_date[$i]."' and memo='".$anniversary[$i]."'";
				//echo $query;
				$item = @mysql_fetch_object(@mysql_query($query));
			
				if($item->uid) {
					$data = array(
						"table" => "schedule",
						"where"=>"uid=".$item->uid,
						"fid" => $uid,
						"id" => $_SESSION['id'],
						"promise_div"=>"",
						"name" => $name,
						"promise_date" => $anniversary_date[$i],
						"promise_time" => "",
						"place" =>"",
						"importance" =>"",
						"memo" => $anniversary[$i],
						"anniversary"=>"y",
						"reg_date" => $now
					);

					$result = $core->update($data);			
				} else {
					$data = array(
						"table" => "schedule",
						"fid" => $uid,
						"id" => $_SESSION['id'],
						"promise_div"=>"",
						"name" => $name,
						"promise_date" => $anniversary_date[$i],
						"promise_time" => "",
						"place" =>"",
						"importance" =>"",
						"memo" => $anniversary[$i],
						"anniversary"=>"y",
						"reg_date" => $now
					);

					$result = $core->insert($data);			
				}
			}
		}
	}
} else { // 고객정보 등록
	$data = array(
		"table" => "customer",
		"gid" => $gid,
		"id" => $_SESSION['id'],
		"sexual" => $sexual,
		"name" => $name,
		"closeness" => $closeness,
		"company" => $company,
		"department" => $department,
		"position" => $position,
		"job" => $job,
		"telephone" => $telephone,
		"mobile" => $mobile,
		"email" => $email,
		"keyman" => $keyman,
		"zipcode" => $zipcode,
		"address1" => $address1,
		"address2" => $address2,
		"relation" => $relation,
		"company_telephone" => $company_telephone,
		"company_fax" => $company_fax,
		"company_zipcode" => $company_zipcode,
		"company_address1" => $company_address1,
		"company_address2" => $company_address2,
		"receive_email" => $receive_email,
		"receive_sms" => $receive_sms,
		"area" => $area,
		"school" => $school,
		"blog" => $blog,
		"sns" => $sns,
		"interest" => $interest,
		"hobby" => $hobby,
		"special" => $special,
		"pre_company" => $pre_company,
		"smoking" => $smoking,
		"religion" => $religion,
		"blood_group" => $blood_group,
		"anniversary1" => $anniversary1,
		"anniversary_date1" => $anniversary_date1,
		"anniversary2" => $anniversary2,
		"anniversary_date2" => $anniversary_date2,
		"anniversary3" => $anniversary3,
		"anniversary_date3" => $anniversary_date3,
		"anniversary4" => $anniversary4,
		"anniversary_date4" => $anniversary_date4,
		"anniversary5" => $anniversary5,
		"anniversary_date5" => $anniversary_date5,
		"memo" => $memo,
		"reg_date" => $now,
		"mod_date" => $now
	);
	$result = $core->insert($data);

	$fid = mysql_insert_id();
	
	$anniversary_date = array($anniversary_date1,$anniversary_date2,$anniversary_date3,$anniversary_date4,$anniversary_date5);
	$anniversary = array($anniversary1,$anniversary2,$anniversary3,$anniversary4,$anniversary5);
	
	if(sizeof($anniversary) > 0) {
		for($i = 0 ; $i < 5 ; $i++){
			if($anniversary_date[$i] != "") {
				$data = array(
					"table" => "schedule",
					"fid" => $uid,
					"id" => $_SESSION['id'],
					"promise_div"=>"",
					"name" => $name,
					"promise_date" => $anniversary_date[$i],
					"promise_time" => "",
					"place" =>"",
					"importance" =>"",
					"memo" => $anniversary[$i],
					"reg_date" => $now
				);

				$result = $core->insert($data);
			}
		}
	}

}

if($result) echo "success";
*/

	// 거래처 리스트
	public function customer_list(){
		require_once ('views/customer/customer_list.php');
	}
	
	// 거래처 등록
	public function customer_regist(){
		require_once ("views/customer/customer_regist.php");
	}

	public function customer_regist_exe(){
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
		if($result) require_once ("views/customer/customer_list.php");
	}

	public function customer_view(){
		$t = Customer::viewCustomer($_GET['uid']);
		require_once('views/customer/customer_view.php');
	}

	public function customer_update_exe(){
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
		if($result) require_once ("views/customer/customer_list.php");
	}
}
?>