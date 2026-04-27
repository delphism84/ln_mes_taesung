<?
define('DB_HOST',"localhost");
define('DB_NAME',"taesung");
define('DB_USER','taesung');
define('DB_PASSWORD','eogksalsrnr');
define('ROOT',$_SERVER["DOCUMENT_ROOT"]);

mysql_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die ("Connect Error");
mysql_select_db(DB_NAME);
mysql_query("set names 'utf8'");

header( "Content-type: application/vnd.ms-excel" );   
header( "Content-type: application/vnd.ms-excel; charset=utf-8");  
header( "Content-Disposition: attachment; filename = invoice.xls" );   
header( "Content-Description: PHP4 Generated Data" );   

$query = "select * from erp_stock_inout ".$_GET['where']." order by item_cd asc";
$result = mysql_query($query);  
  
// 테이블 상단 만들기  
$EXCEL_STR = "  
<table border='1'>  
<tr>  
   <td>날짜</td>  
   <td>거래처</td>  
   <td>적요</td>
   <td>Lot_no</td> 
   <td>입고수량</td> 
   <td>출고수량</td> 
   <td>재고수량</td>
</tr>";  
  
while($row = mysql_fetch_array($result)) {  

   if($row['remark'] !="창고이동입고" ){ 
	   $in_cnt =$row['in_cnt']; $out_cnt= $row['out_cnt'];
   }else{
	   $in_cnt = "" ; $out_cnt= "";
   }


   $EXCEL_STR .= "  
   <tr>  
       <td>".$row['create_dt']."</td>  
       <td>".$row['account']."</td>  
       <td>".$row['remark']."</td>
       <td>".$row['lot_no']."</td>
       <td>".$in_cnt."</td>  
       <td>".$out_cnt."</td>  
       <td>".$row['remain_cnt']."</td>
   </tr>  
   ";  
}  
  
$EXCEL_STR .= "</table>";  
  
echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";  
echo $EXCEL_STR;  
?>