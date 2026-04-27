<?
class Accounting {
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
	public function insertAccountingCodeRemark($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function viewAccountCodeRemarkViewPop($uid) {
		$query = "select * from erp_account_code_remark where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function UpdateAccountingCodeRemark($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function insertAccountingCode($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function viewAccountCodeView($uid) {
		$query = "select * from erp_account_code where uid=" . $uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function UpdateAccountingCode($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

}
?>