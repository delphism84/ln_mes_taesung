<?
session_start();

extract($_GET);
extract($_POST);

include "connection.php";

?>
<style>
ul.pagination {
    display: inline-block;
    padding: 0;
    margin: 0;
}

ul.pagination li {display: inline;}

ul.pagination li a {
    color: black;
    float: left;
    padding: 4px 8px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 2px;
}

ul.pagination li a.active {
    background-color: #0da2d7;
    color: white;
    border: 1px solid #018fc2;

ul.pagination li a:hover:not(.active) {background-color: #ddd;}
</style>

<?
function doPaging($page = 1, $table, $where, $rpp = 15, $adjacents = 1, $setPage) 
{
	$query = "select uid from ".$table." ".$where; 
	//echo $query;
	//echo $rpp;
	//echo $adjacents;
	$result = mysql_query($query);
	$total = @mysql_num_rows($result);
	//echo $total;
	if(($last = ceil($total/$rpp)) > 1) 
	{
		if($last < ($defc = 1+$adjacents*2)) 
		{
			$i = 1;
			$cond = $last;
		}
		elseif($last >= $defc) 
		{
			if($page < 2+$adjacents) {
			$i = 1;
			$cond = $defc/2+$page;
			$laston = true;
		}
		elseif($page >= $last-$defc/2) 
		{
			$i = $last+1-$defc;
			$cond = $last;
			$firston = true;
		}
		elseif($page >= 2+$adjacents) 
		{
			$i = $page-$adjacents;
			$cond = $page+$adjacents;
			$firston = true;
			$laston = true;
		}
	}
	
	$tag = "<ul class='pagination'>";

	if($firston) 
	{
		$tag .= "<li><a href='#' onclick='".$setPage."(1)'><<</a></li>";
	}
	
	for($i; $i <= $cond; $i++) 
	{
		if($i == $page) 
		{
			$tag .= "<li><a href='#' class='active'>".$i."</a></li>";
		}
		else 
		{
			$tag .= "<li><a href='#' onclick='".$setPage."(".$i.")'>".$i."</a></li>";
		}
	}

	if($laston) 
	{
		$tag .= "<li><a href='#' onclick='".$setPage."(".$last.")'>>></a></li>";
	}
	else {
		$tag .= "";
	}
	
	$tag .= "</ul>";
	echo $tag;
	}
}

$where = str_replace("@","%",$where);
//echo $where;
doPaging($page, $table, $where, $rpp, $adjacents, $setPage) ;
?>