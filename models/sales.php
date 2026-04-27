<?
session_start();
class Sales {
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
		//echo $query."<BR>";
		if(mysql_query($query)) return true;
		else return false;
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
		//echo $query."<BR>";
		if(mysql_query($query)) return true;
		else return false;
	}

/*****************************************************************************************************************************/
// 공용라이브러리 끝
/*****************************************************************************************************************************/
	// 거래처 등록
	public function registAccount($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getAccount($uid) {
		$query = "select * from erp_account where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function getEstimate($uid) {
		$query = "select * from erp_estimate where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updateAccount($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	// 견적서 등록
	public function registEstimate($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}

	public function registPurchaseDemand($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}

	public function registPurchaseDemandItem($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}

	public function registEstimateItem($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}	

	public function updateEstimate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	// 수주서 등록
	public function registOrder($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}

	public function registOrderItem($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}	

	public function getOrder($uid) {
		$query = "select * from erp_order where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function getOrderShipment($uid) {
		$query = "select * from erp_order_shipment where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	// 구매단가 가져오기
	public function getPurUnitPrice($item_cd, $standard1, $standard2, $standard3){
		$query = "select pur_unit_price from erp_item where item_cd='". $item_cd ."' and standard1='" .$standard1 . "' and standard2='" .$standard2 . "' and standard3='" .$standard3 . "'";
		$result = mysql_query($query);
		$price = mysql_fetch_object($result);
		if($price->pur_unit_price > 0) return $price->pur_unit_price;
		else return "0";
	}
	
	// AS 등록
	public function registAs($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getAs($uid) {
		$query = "select * from erp_as where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updateAs($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function deleteEstimateItem($uid) {
		$sql = "delete from erp_estimate_item where fid=".$uid;
		mysql_query($sql);
	}

	// 출하지시서 등록
	public function registOrderShipment($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}

	public function registOrderItemShipment($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}	
}
?>