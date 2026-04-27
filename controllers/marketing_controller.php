<?
//========================
// 영업관리 컨트럴러
// 생성일 : 2017-08-23
// 최종 수정일 : 2017-08-23
//========================

class MarketingController {
	// 거래명세서 리스트
	public function listSpecificationOnTransaction() {
		$data = Marketing::getListMarketing();
		require_once('views/marketing/listSpecificationOnTransaction.php');
	}

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