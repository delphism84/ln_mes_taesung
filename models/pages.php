<?
session_start();

class Pages {
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

	public function loging($id,$pwd){
		$query = "select * from erp_employee where emp_id='".$id."'";
		$result = mysql_query($query) or die (mysql_error());

		$t = mysql_fetch_object($result);

		if(!isset($t->uid)) {
			return false;
			
		} else {
			if($pwd == $t->emp_pwd) {
				$_SESSION['emp_uid'] = $t->uid;
				return true;
			}	
		}
	}
}
?>