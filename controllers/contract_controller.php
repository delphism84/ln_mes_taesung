<?
class ContractController {
/*

//$core->query("select * from customer");
// 기등록자 검사 필요
$now = date("Y-m-d h:i:s");

// 계약정보 등록

if($uid == "") {
	$data = array(
		"table" => "contract",
		"id" => $_SESSION['id'],
		"fid" => $fid,
		"ins_company" => $ins_company,
		"contract_num" => $contract_num,
		"join_date" => $join_date,
		"end_date" => $end_date,
		"ins_div" => $ins_div,
		"payment" => $payment,
		"payment_year" => $payment_year,
		"guarantee_year" => $guarantee_year,
		"policyholder" => $policyholder,
		"insurant" => $insurant,
		"relation" => $relation,
		"memo" => $memo,
		"reg_date" => $now
	);

	//var_dump($data);
	$result = $core->insert($data);
	
	$query = "select name from customer where uid=".$fid;
	$res = mysql_fetch_object(mysql_query($query));

	$data = array(
		"table" => "schedule",
		"fid" => $fid,
		"id" => $_SESSION['id'],
		"name" => $res->name,
		"promise_date" => $end_date,
		"importance" =>"상",
		"memo" => $ins_div."만기일",
		"anniversary"=>"y",
		"reg_date" => $now
	);

	$result = $core->insert($data);	
} else {
	$data = array(
		"table" => "contract",
		"where" => "uid=".$uid,
		"ins_company" => $ins_company,
		"contract_num" => $contract_num,
		"join_date" => $join_date,
		"end_date" => $end_date,
		"ins_div" => $ins_div,
		"payment" => $payment,
		"payment_year" => $payment_year,
		"guarantee_year" => $guarantee_year,
		"policyholder" => $policyholder,
		"insurant" => $insurant,
		"relation" => $relation,
		"memo" => $memo
	);

	//var_dump($data);
	$result = $core->update($data);
}

if($result) echo "success";
*/

	// 거래처 리스트
	public function contract_list(){
		require_once ('views/contract/contract_list.php');
	}
	
	// 거래처 등록
	public function contract_regist(){
		require_once ("views/contract/contract_regist.php");
	}

	public function contract_regist_exe(){
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
		if($result) require_once ("views/contract/contract_list.php");
	}

	public function contract_view(){
		$t = Contract::viewContract($_GET['uid']);
		require_once('views/contract/contract_view.php');
	}

	public function contract_update_exe(){
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
		if($result) require_once ("views/contract/contract_list.php");
	}
}
?>