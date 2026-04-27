<?
session_start();
/******************************************************************************************************
:: 인사/급여
******************************************************************************************************/	
class Employee {
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
		//echo $query;
		if(mysql_query($query)) return true;
		else return false;
	}

/*****************************************************************************************************************************/
// 공용라이브러리 끝
/*****************************************************************************************************************************/

/******************************************************************************************************
:: 부서 관련 함수들
******************************************************************************************************/	
	// 사원 등록
	public function registEmployee($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getEmployee($uid) {
		$query = "select * from erp_employee where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updateEmployee($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
/******************************************************************************************************
:: 부서 관련 함수들
******************************************************************************************************/	
	// 부서 등록
	public function registDepartment($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getDepartment($uid) {
		$query = "select * from erp_department where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updateDepartment($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
/******************************************************************************************************
:: 직위 관련 함수들
******************************************************************************************************/	
	// 직위 등록
	public function registPosition($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getPosition($uid) {
		$query = "select * from erp_position where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updatePosition($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
/******************************************************************************************************
:: 일용직 관련 함수들
******************************************************************************************************/
	public function registDailyWorker($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function updateDailyWorker($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function getDailyWorker($uid) {
		$query = "select * from erp_daily_worker where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}
}
?>