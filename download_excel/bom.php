<?
require_once ("../connection.php");

header( "Content-type: application/vnd.ms-excel; charset=euc-kr" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
header( "Pragma: public" );
header( "Content-Disposition: attachment; filename=bom.xls" );

$sql = "select * from erp_bom";
$result = mysql_query($sql);

echo "
	<table border ='1'>
		<tr>
			<td><span style='color:red'>부모제품</span></td>
			<td><span style='color:red'>품목코드</span></td>
			<td><span style='color:red'>품목명</span></td>
			<td><span style='color:red'>규격</span></td>
			<td><span style='color:red'>단위</span></td>
			<td><span style='color:red'>소요량</span></td>
		</tr>
";

while ($t = mysql_fetch_object($result)) {
	echo "<tr>";
	echo "<td>$t->fid</td>";
	echo "<td>$t->item_cd</td>";
	echo "<td>$t->item_nm</td>";
	echo "<td>$t->standard</td>";
	echo "<td>$t->unit</td>";
	echo "<td>$t->cnt</td>";
	echo "</tr>";
}

echo "</table>";
?>