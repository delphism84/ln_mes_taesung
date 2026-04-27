<?
session_start();
/******************************************************************************************************
:: 설비관리
******************************************************************************************************/	
class Facilities {
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
:: 부서 관련 함수들
******************************************************************************************************/	
	// 사원 등록
	public function registFacilities($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getFacilitiess($uid) {
		$query = "select * from erp_Salary where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updateFacilities($data) {
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
/******************************************************************************************************
:: 급여 관련 함수들
******************************************************************************************************/
	public function facilitiesItmeInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function facilitiesItmeUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	public function declarationItmeInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function declarationItmeUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function payCheckInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function payCheckUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function getPayCheck($uid) {
		$query = "select * from erp_pay_check where uid='" . $uid."'";
		//echo $query;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function payMemberInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function payMemberUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function getPayMember($pay_check_dt, $pay_check_ca, $emp_cd) {
		$query = "select * from erp_pay_member_item where pay_check_dt='" . $pay_check_dt."' and pay_check_ca='".$pay_check_ca."' and emp_cd='".$emp_cd."'";
		//echo $query;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function getFacilities($uid) {
		$query = "select * from erp_facilities where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function getFacilitiesManagement($uid) {
		$query = "select * from erp_facility_management where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}
	
}
?>