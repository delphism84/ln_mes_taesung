<?
session_start();
class Groupware {
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
	// 거래처 등록
	public function registProject($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function updateProject($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function registProjectAttach($data) {
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	// 결재라인 등록
	public function registEleSettlementLine($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}

	public function registEleSettlementEmp($data) {
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}
	
	//기안등록
	public function registEleSettlement($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}
	
	// 기안 결재자 등록
	public function registApprovalCheck($fid,$approval_uid){
		$query = "select * from erp_ele_settlement_emp where fid=". $approval_uid;
		$result = mysql_query($query);
		while($t = mysql_fetch_object($result)) {
			$data = array(
				"table" => "erp_approval_check",
				"fid" => $fid,
				"emp_id" => $t->emp_id,
				"sign" => "n",
				"seq" => $t->seq,
				"sign_dt" => ""
			);

			$this->insert($data);
		}
	}

	public function getProject($uid){
		$query = "select * from erp_project where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function getEleSettlement($uid){
		$query = "select * from erp_approval where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	// 기기등록
	public function registMachine($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	// 파일등록
	public function registFile($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	// 업무공유등록
	public function registBoard($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	// 공용품 등록
	public function registPublicThing($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	// 차량 등록
	public function registCar($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getCar($uid){
		$query = "select * from erp_car where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	// CRM
	public function getCrm($uid){
		$query = "select * from erp_customer where uid=".$uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function getSchedule($uid){
		$query = "select * from erp_schedule where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}
}
?>