<?
session_start();
class Items {
	public function __construct() {}
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
	// 창고 등록
	public function registWarehouse($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getWarehouse($uid) {
		$query = "select * from erp_warehouse where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updateWarehouse($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	// 품목 등록
	public function registItem($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getItem($uid) {
		$query = "select * from erp_item where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	// 출고요청서 가져오기
	public function getRelease($uid) {
		$query = "select * from erp_release where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function getReleaseRequest($uid) {
		$query = "select * from erp_release_request where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updateItem($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function registStock($data) {
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getStock($uid) {
		$query = "select * from erp_stock where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function inputReleaseRequestItem($data){
	$result = $this->insert($data);
	if($result) return mysql_insert_id();
	else return false;	
	}
}
?>