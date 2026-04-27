<?
require_once ("../connection.php");

header( "Content-type: application/vnd.ms-excel; charset=euc-kr" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
header( "Pragma: public" );
header( "Content-Disposition: attachment; filename=employee.xls" );

$sql = "select * from erp_employee";
$result = mysql_query($sql);

echo "
	<table border ='1'>
		<tr>
			<td><span style='color:red'>사원번호</span></td>
			<td><span style='color:red'>사원명</span></td>
			<td><span style='color:red'>사원아이디</span></td>
			<td><span style='color:red'>사원비밀번호</span></td>
			<td>성별</td>
			<td><span style='color:red'>휴대전화번호</span></td>
			<td><span style='color:red'>부서(대)</span></td>
			<td>부소(중)</td>
			<td>부서(소)</td>
			<td><span style='color:red'>직급</span></td>
			<td>입사일자</td>
			<td><span style='color:red'>이메일</span></td>
		</tr>
";

while ($t = mysql_fetch_object($result)) {
	echo "<tr>";
	echo "<td>$t->emp_cd</td>";
	echo "<td>$t->emp_nm</td>";
	echo "<td>$t->emp_id</td>";
	echo "<td>$t->emp_pwd</td>";
	echo "<td>$t->sex_gb</td>";
	echo "<td>$t->emp_mobile</td>";
	echo "<td>$t->big_department_nm</td>";
	echo "<td>$t->middle_department_nm</td>";
	echo "<td>$t->small_department_nm</td>";
	echo "<td>$t->position_nm</td>";
	echo "<td>$t->join_dt</td>";
	echo "<td>$t->emp_email</td>";
	echo "</tr>";
}

echo "</table>";
?>