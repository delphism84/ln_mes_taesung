<?
session_start();

class Base {
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
		//echo $query;
		if(mysql_query($query)) return true;
		else return false;
	}

	public function get($uid, $table) {
		$query = "select * from erp_".$table." where uid=".$uid;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function deleteStock($item_cd, $standard1, $standard2, $standard3) {
		//$sql = "delete from erp_stock where item_cd='".$item_cd."' and standard1='".$standard1."' and standard2='".$standard2."' and standard3='".$standard3."'";
		$sql = "delete from erp_stock where item_cd='".$item_cd."' and standard1='".$standard1."' ";
		mysql_query($sql);
	}
}
?>