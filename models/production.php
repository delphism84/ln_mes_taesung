<?
session_start();
class Production {
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
		//echo $query;
		//exit;
		if(mysql_query($query)) return true;
		else return false;
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
		mysql_query($query) or die (mysql_error());
		exit;
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
	// 창고 등록
	public function registProcess($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getProcess($uid) {
		$query = "select * from erp_process where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updateProcess($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function getBom($uid) {
		$query = "select * from erp_bom where fid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function registBom($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function checkBom($uid, $item_cd, $standard1, $standard2, $standard3, $unit) {
		$query = "select uid from erp_bom where fid=" . $uid . " and item_cd='" . $item_cd . "' and standard1='" . $standard1 . "' and standard2='" . $standard2 . "' and standard3='" . $standard3 . "' and unit='" . $unit ."'";
		$result = mysql_num_rows(mysql_query($query));
		if($result > 0) return false;
		else return true;
	}

	public function getOrder($uid) {
		$query = "select * from erp_order where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function getWorkOrder($uid) {
		$query = "select * from erp_work where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	// 생산계획 등록
	public function registWorkPlan($data) {
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;
	}

	// 생산계획 등록 아이템 등록
	public function registWorkPlanItem($data) {
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function registWork($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function inputWork($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;
	}

	public function updateWork($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;	
	}

	public function registWorkItem($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;
	}

	public function updateWorkItem($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;	
	}

	public function getWorkPlan($uid) {
		$query = "select * from erp_workplan where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function getWork($uid) {
		$query = "select * from erp_work where uid=" . $uid;
		//echo $query;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function updateWorkPlan($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	/*
	public function productPerfReportsInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}
	*/

	public function productPerfReportsInsert($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;
	}

	public function productPPReportsInserts($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;
	}

	public function productPerfReportsUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;	
	}

	public function productPerfReportsBarcodeInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function productPerfReportsLotNoInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function getProductPerfReports($uid) {
		$query = "select * from erp_product_perf_repost where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}
	/*
	public function getProductOutput($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}
	*/
	
	public function getProductOutput($data){
		$query = "select * from erp_product_perf_repost where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function getProductionWearing($uid) {
		$query = "select * from erp_production_wearing where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function inputProductionWearing($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;
	}
	

	public function getWorkDailyReport($uid) {
		$query = "select * from erp_work_daily_report where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}
	public function getProductionInto($uid) {
		$query = "select * from erp_production_into where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function input_p_into($data){
	$result = $this->insert($data);
	if($result) return mysql_insert_id();
	else return false;	
	}
	
	public function getPPReportsPrint($uid) {
		$query = "select * from erp_product_perf_repost_lotno where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}
}
?>