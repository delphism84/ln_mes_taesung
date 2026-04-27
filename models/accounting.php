<?
session_start();
class Accounting {
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
		echo $query."<BR>";
		
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
	

	public function insertCreditCardCode($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function UpdateCreditCardCode($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function insertBankData($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function UpdateBankData($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function insertPrintApplineData($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;	
	}

	public function UpdatePrintApplineData($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function insertTable($table,$data){
		$fields = get_table_fields($table);
		$data	= array_keys_intersect($data,$fields);
		if (!$table or !is_array($data)) return false;
		//$data = quote($data);
		$columns = implode(', ',array_keys($data));
		$values = implode("', '",array_values($data));
		$sql = "INSERT INTO $table ($columns) VALUES ('$values')";
		//echo $sql."<br>";
		query($sql);
		return mysql_insert_id();
	}

	public function updateTable($table,$data,$cond=""){
		$fields = get_table_fields($table);
		$data = array_keys_intersect($data,$fields);
		if(!$table or !is_array($data)) return false;
		//$data = quote($data);
		foreach ($data as $key=>$value)
			$aTmp[] = $key."='" .$value."'";
		$sql = "UPDATE $table SET ".implode(", ",$aTmp)." $cond";
		//echo $sql."<BR><BR>";
		return query($sql);
	}

	public function insertCardCompany($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function UpdateCardCompany($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function registStatement($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}

	public function registGeneralStatementInsertId($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}

	public function registGeneralStatementItem($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}	

	public function generalStatementUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function generalStatementItemUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function registSalesStatementInsertId($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}

	public function registSalesStatementItem($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}	
	public function salesStatementUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function salesStatementItemUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	

	public function registPurchaseStatementInsertId($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}

	public function registPurchaseStatementItem($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}	

	public function purchaseStatementUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	
	public function registStatementInsert($data) {
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}
	
	public function registStatementUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function StatementChaMaxNum($dt,$ca) {
		$query = "select MAX(statement_ca) AS macha from erp_g_statement where statement_dt='" . $dt ."'";
		$row = mysql_fetch_array(mysql_query($query));
		$max = $row['macha']+1;
		return $max;
	}
 
	public static function getGeneralStatement($gid) {
		$query = "select * from erp_g_statement where gid=".$gid;
		//echo $query;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public static function getGeneralStatementItem($gid) {
		$query = "select uid from erp_g_statement_item where gid=".$gid;
		//echo $query;
		$s = mysql_fetch_object(mysql_query($query));
		return $s;
	}

	public static function getSalesStatement($sid) {
		$query = "select * from erp_s_statement where sid=".$sid;
		//echo $query;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public static function getPurchaseStatement($pid) {
		$query = "select * from erp_p_statement where pid=".$pid;
		//echo $query;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}
	
	public function taxInvoiceInsert($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	
	public function registTaxInvoiceInsertId($data){
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}
	
	public function registTaxInvoiceItem($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}
	
	public function taxInvoiceUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	
	public function taxInvoiceItemUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public static function getTaxInvoice($statement_no) {
		$query = "select * from erp_tax_invoice where statement_no='".$statement_no."'";
		//echo $query;
		$t = mysql_fetch_object(mysql_query($query));
		return $t;
	}

	
	public function registCustomerDepositInsert($data) {
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}

	public function customerDepositUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function registDepositReportInsertId($data) {
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}
	
	public function registDepositReportItem($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}

	public function depositReportUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function depositReportItemUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function registSpendingResolutionInsertId($data) {
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}
	public function registSpendingResolutionItem($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}
	
		
	public function GeneralReceiptsInsert($data) {
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}
	public function GeneralReceiptsUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function CardSalesSlipsInsert($data) {
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}
	public function CardSalesSlipsUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	

	public function  SettleAccPrepaymentsInsertId($data) {
		$result = $this->insert($data);
		if($result) return mysql_insert_id();
		else return false;	
	}

	public function  registSettleAccPrepaymentsItem($data) {
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}

	public function  SettleAccPrepaymentsUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function  SettleAccPrepaymentsItemUpdate($data) {
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function EtcDepositInsert($data) {
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}
	public function EtcDepositUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	
	public function FixedAssetsInsert($data) {
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}
	public function FixedAssetsUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public static function getFixedAssetsStatement($uid) {
		$query = "select * from erp_fixed_assets_statement where uid=".$uid;
		//echo $query;
		$t = @mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function fixedAssetsStatementInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}

	public function fixedAssetsStatementUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public function fixedAssetsTypeInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}

	public function fixedAssetsTypeUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public static function getFixedAssetsType($uid) {
		$query = "select * from erp_fixed_assets_type where uid=".$uid;
		//echo $query;
		$t = @mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function fixedAssetsCodeInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}

	public function fixedAssetsCodeUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	
	public static function getFixedAssetsCode($uid) {
		$query = "select * from erp_fixed_assets_code where uid=".$uid;
		//echo $query;
		$t = @mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function fixedAssetsIncrementInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}

	public function fixedAssetsIncrementUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}
	
	public static function getFixedAssetsIncrement($uid) {
		$query = "select * from erp_fixed_assets_increment where uid=".$uid;
		//echo $query;
		$t = @mysql_fetch_object(mysql_query($query));
		return $t;
	}

	public function fixedAssetsDecreaseInsert($data){
		$result = $this->insert($data);
		if($result) return true;
		else return false;
	}

	public function fixedAssetsDecreaseUpdate($data){
		$result = $this->update($data);
		if($result) return true;
		else return false;
	}

	public static function getFixedAssetsDecrease($uid) {
		$query = "select * from erp_fixed_assets_decrease where uid=".$uid;
		//echo $query;
		$t = @mysql_fetch_object(mysql_query($query));
		return $t;
	}


	
}
?>