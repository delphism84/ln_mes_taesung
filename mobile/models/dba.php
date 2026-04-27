<?
class Dba {
	private $result;
	private $sub_result;

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
		$t = @mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function clientGet($uid, $table) {
		$query = "select * from ".$table." where uid=".$uid;
		$t = @mysql_fetch_object(mysql_query($query));
		return $t;
	}


	public function Mysql_DB ($db_host, $db_user, $db_pass, $db_name) {
		$this->connect_db($db_host, $db_user, $db_pass);
		$this->select_db($db_name);
	}

	public function connect_db($db_host, $db_user, $db_pass) {
		$this->db = @mysql_connect($db_host, $db_user, $db_pass);
		mysql_query("set names 'utf8'");
		if(is_resource($this->db) == false) {
			$this->trace_error($db_host."에 접속할수 없습니다.");
		}
	}

	public function select_db($db_name) {
		@mysql_select_db($db_name, $this->db) or $this->trace_error($db_name."을 선택할수 없습니다.");
	}

	public function get_insert_id() {
		return mysql_insert_id();
	}

	/*
	db에서 select 쿼리를 실행하는 함수
	*/
	public function query($query) {

		if(is_resource($this->db) == false) {
			$this->trace_error("execute_query error. db 접속이 유효하지 않습니다.");
			return;
		}
		$this->result = @mysql_query($query, $this->db) or $this->trace_error("Query Error : ".$query);
	}

	public function sub_query($query) {

		if(is_resource($this->db) == false) {
			$this->trace_error("execute_query error. db 접속이 유효하지 않습니다.");
			return;
		}
		$this->sub_result = @mysql_query($query, $this->db) or $this->trace_error("쿼리문에 문제가 있습니다.");
	}

	/*
	db 에서 insert, delect, update 쿼리를 실행하는 함수
	return : 적용된 rows 수, 에러가 있다면, -1를 반환
	*/
	public function execute_update($query) {
		$result = mysql_query($query, $this->db); //
		if(is_resource($result)) return mysql_affected_rows($result);
		return -1;
	}

	/*
	select query된 result set을 반환한다.
	꼭 필요한 경우 사용하고 보통은 next_fetch()를 사용하도록 한다.
	*/
	public function get_result() {
		return $this->result;
	}

	public function get_sub_result() {
		return $this->sub_result;
	}

	/*
	execute_count() 함수는 select count(*) 등과 같은 단순 select 쿼리를 fetch하여
	결과값을 반환하는 함수이다. 솔직히 이런거 가져올때 이것저것 호출하면 귀찮다.
	return : 정상정인 값은 0 이상이며, select 된 row가 없으면, -1을 반환
	*/
	public function execute_simple_query($query) {
		$result = mysql_query($query, $this->db);
		if(!is_resource($result)) return -1;
		return mysql_result($result, 0, 0);
	}

	/*
	select 쿼리된 개수를 반환한다.
	return : 정상적 쿼리가 아니면, -1 을 return
	*/
	public function get_rows() {
		if(is_resource($this->result)) return mysql_num_rows($this->result);
		return -1;
	}

	public function sub_get_rows() {
		if(is_resource($this->sub_result)) return mysql_num_rows($this->sub_result);
		return -1;
	}

	/*
	$result를 하나 fetch 한다.
	db간의 호환성을 높이기 위해 함수를 따로 만든다.
	*/
	public function next_fetch() {
		return @mysql_fetch_assoc($this->result);
	}

	/*
	next_fetch()와 동일 함수이다. 취향대로 쓰기 바랍니다.
	*/
	public function next_row() {
		return @mysql_fetch_assoc($this->result);
	}

	public function fetch() {
		return @mysql_fetch_object($this->result);
	}

	public function sub_fetch() {
		return @mysql_fetch_object($this->sub_result);
	}

	/*
	에러 메세지를 출력한다.
	*/
	public function trace_error($msg) {
		$text  = "<FONT COLOR=\"#ff0000\"><P>Error: $msg : </p>";
		$text .= mysql_error();
		$text .= "</FONT>\n";
		die($text);
	}

	/*
	db 와 연결된 자원을 반납한다.
	페이지 output이 끝나면 자동적으로 접속이 끊기지만, 명시적으로
	db접속이 끊기는걸 넣어주는게 좋습니다.
	*/
	public function destroy() {
		if(is_resource($this->result)) mysql_free_result($this->result);
		mysql_close($this->db);
	}

	/*
	destroy()라는 이름보다 close()를 선호하실거 같아 넣었습니다.
	*/
	public function close() {
		$this->destroy();
	}
}
?>