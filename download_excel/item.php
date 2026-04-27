<?
require_once ("../connection.php");

header( "Content-type: application/vnd.ms-excel; charset=euc-kr" );
header( "Expires: 0" );
header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
header( "Pragma: public" );
header( "Content-Disposition: attachment; filename=item.xls" );

$sql = "select * from erp_item";
$result = mysql_query($sql);

echo "
	<table border ='1'>
		<tr>
			<td><span style='color:red'>품목구분</span></td>
			<td>품목그룹</td>
			<td><span style='color:red'>품목코드</span></td>
			<td><span style='color:red'>품목명</span></td>
			<td><span style='color:red'>단위</span></td>
			<td><span style='color:red'>규격</span></td>
			<td><span style='color:red'>최소구매단위</span></td>
			<td><span style='color:red'>입고창고</span></td>
			<td>구매처</td>
			<td>조달기간</td>
			<td><span style='color:red'>기초재고수량</span></td>
			<td><span style='color:red'>안전재고수량</span></td>
			<td>입고단가</td>
			<td>출고단가</td>
			<td>입고바코드</td>
			<td>출고바코드</td>
		</tr>
";

while ($t = mysql_fetch_object($result)) {
	echo "<tr>";
	echo "<td>$t->item_gb</td>";
	echo "<td>$t->item_group_nm</td>";
	echo "<td>$t->item_cd</td>";
	echo "<td>$t->item_nm</td>";
	echo "<td>$t->unit</td>";
	echo "<td>$t->standard</td>";
	echo "<td>$t->min_pur_unit</td>";
	echo "<td>$t->warehouse_nm</td>";
	echo "<td>$t->account_nm</td>";
	echo "<td>$t->delivery_period</td>";
	echo "<td>$t->base_stock_cnt</td>";
	echo "<td>$t->safety_stock_cnt</td>";
	echo "<td>$t->pur_unit_price</td>";
	echo "<td>$t->unit_price</td>";
	echo "<td>$t->in_barcode</td>";
	echo "<td>$t->barcode</td>";
	echo "</tr>";
}

echo "</table>";
?>