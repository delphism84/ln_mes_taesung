<?
require_once ("../connection.php");

header( "Content-type: application/vnd.ms-excel; charset=euc-kr" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
header( "Pragma: public" );
header( "Content-Disposition: attachment; filename=account.xls" );

$sql = "select * from erp_account";
$result = mysql_query($sql);

echo "
	<table border ='1'>
		<tr>
			<td><span style='color:red'>거래처구분</span></td>
			<td><span style='color:red'>거래처코드</span></td>
			<td><span style='color:red'>거래처명</span></td>
			<td><span style='color:red'>대표자명</span></td>
			<td>대표자연락처</td>
			<td>사업자등록번호</td>
			<td>업태</td>
			<td>종목</td>
			<td><span style='color:red'>전화</span></td>
			<td><span style='color:red'>팩스</span></td>
			<td><span style='color:red'>대표이메일</span></td>
			<td><span style='color:red'>담당자</span></td>
			<td>우편번호</td>
			<td>주소</td>
			<td>거래처아이디</td>
			<td>거래처비밀번호</td>
		</tr>
";

while ($t = mysql_fetch_object($result)) {
	echo "<tr>";
	echo "<td>$t->account_gb</td>";
	echo "<td>$t->account_cd</td>";
	echo "<td>$t->account_nm</td>";
	echo "<td>$t->owner</td>";
	echo "<td>$t->owner_mobile</td>";
	echo "<td>$t->corp_reg_no</td>";
	echo "<td>$t->corp_condition</td>";
	echo "<td>$t->corp_event</td>";
	echo "<td>$t->corp_phone</td>";
	echo "<td>$t->corp_fax</td>";
	echo "<td>$t->corp_email</td>";
	echo "<td>$t->manager</td>";
	echo "<td>$t->corp_zipcode</td>";
	echo "<td>$t->corp_address</td>";
	echo "<td>$t->account_id</td>";
	echo "<td>$t->account_pwd</td>";
	echo "</tr>";
}

echo "</table>";
?>