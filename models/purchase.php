<?
session_start();
class Purchase {
	public function __construct() {
		extract($_POST);
		extract($_GET);
	}
/*****************************************************************************************************************************/
// 공용라이브러리
/*****************************************************************************************************************************/
	public function insert($data){
		foreach($data as $key => $value){
			if($key == "table") {
				$query = "insert into ".$value." ";
			} else {
				$field .= $key.",";
				if(is_numeric($value)) {
					$prefix = "";
					$suffix = "";
				} else {
					$prefix = "'";
					$suffix = "'";
				}

				$val .= $prefix.$value.$suffix.",";
			}
		}
			
		$query = $query."(".substr($field, 0, -1).")values(".substr($val, 0, -1).")";

		if(mysql_query($query)) {
			return true;
		} else {
			echo $query;
			return false;
		}
	}

	public function insert2($data){
		foreach($data as $key => $value){
			if($key == "table") {
				$query = "insert into ".$value." ";
			} else {
				$field .= $key.",";
				if(is_numeric($value)) {
					$prefix = "";
					$suffix = "";
				} else {
					$prefix = "'";
					$suffix = "'";
				}

				$val .= $prefix.$value.$suffix.",";
			}
		}
			
		$query = $query."(".substr($field, 0, -1).")values(".substr($val, 0, -1).")";
		echo $query;
		//mysql_query($query) or die (mysql_error());
		exit;
	}


	public function update($data){
		foreach($data as $key => $value){
			if($key == "table") {
				$query = "update ".$value." set ";
			} else if($key == "where") {
				$where = " where ".$value;
			} else {
				$field .= $key."=";
				if(is_numeric($value)) {
					$prefix = "";
					$suffix = "";
				} else {
					$prefix = "'";
					$suffix = "'";
				}

				$field .= $prefix.$value.$suffix.",";
			}
		}
			
		$query = $query.substr($field, 0, -1).$where;
		//echo $query;
		if(mysql_query($query)) return true;
		else return false;
	}

/*****************************************************************************************************************************/
// 공용라이브러리 끝
/*****************************************************************************************************************************/
	
	// 구매요청서 등록
	public function registPurchaseDemand($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}
	
	// 구매요청 품목 등록
	public function registPurchaseDemandItem($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}	
	
	public function getPurchaseDemand($uid) {
		$query = "select * from erp_purchase_demand where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function getPurchaseOrder($uid) {
		$query = "select * from erp_purchase_order where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function viewPurchaseDemand($uid) {
		$query = "select * from erp_purchase_demand where uid='" . $uid ."'";
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updatePurchaseDemand($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	
	public function inputPurchaseOrderItem($data){
	$result = $this->insert($data);
	if($result) return mysql_insert_id();
	else return false;	
	}

	public function updatePurchaseOrderItem($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	
	public function inputWarehousingItem($data){
	$result = $this->insert($data);
	if($result) return mysql_insert_id();
	else return false;	
	}

	public function updateWarehousingItem($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function getWarehousing($uid) {
		$query = "select * from erp_warehousing where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

}
?>