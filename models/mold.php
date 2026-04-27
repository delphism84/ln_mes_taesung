<?
session_start();
/******************************************************************************************************
:: 설비관리
******************************************************************************************************/	
class Mold {
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
				if(is_numeric($value) && substr($value, 0, 2) != "00") {
					$prefix = "";
					$suffix = "";
				} else {
					$prefix = "'";
					$suffix = "'";
				}

				$val .= $prefix.$value.$suffix.",";
			}
		}
			
		$query = $query."(".substr($field, 0, -1).") values(".substr($val, 0, -1).")";
		//echo $query."<BR>";
		//exit;
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
		//exit;
		if(mysql_query($query)) return true;
		else return false;
	}

/*****************************************************************************************************************************/
// 공용라이브러리 끝
/*****************************************************************************************************************************/

/******************************************************************************************************
:: 금형등록 함수들
******************************************************************************************************/	

	public function registMold($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getMolds($uid) {
		$query = "select * from erp_mold where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updateMold($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	
	public function insertMold($data) {
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;
	}


	public function registMoldHits($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getMoldHits($uid) {
		$query = "select * from erp_mold_hits where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updateMoldHits($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	
	public function insertMoldHits($data) {
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;
	}

	public function mysqlInsertId($data) {
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;
	}

	public function getMoldRepair($uid) {
		$query = "select * from erp_mold_repair where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}
}
?>