<?
session_start();

include "connection.php";
extract($_POST);
extract($_GET);

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

function doPaging($page = 1, $table, $where, $rpp = 15, $adjacents = 1) 
{	
	//PAGINATION//
$sql = "select * from ".$table.$where." order by a.uid desc";
$result = mysql_query($sql);
//echo $sql;
$total = mysql_num_rows($result);

$adjacents = 3;
$targetpage = $_SERVER['PHP_SELF']; //your file name

$limit = 10; //how many items to show per page
if(isset($page))
{
    $page = $page;
}else{
    $page = 0;
}

if($page){ 
    $start = ($page - 1) * $limit; //first item to display on this page
}else{
    $start = 0;
}

/* Setup page vars for display. */
    if ($page == 0) $page = 1; //if no page var is given, default to 1.
    $prev = $page - 1; //previous page is current page - 1
    $next = $page + 1; //next page is current page + 1
    $lastpage = ceil($total/$limit); //lastpage.
    $lpm1 = $lastpage - 1; //last page minus 1

$sql2 = "select * from ".$table.$where;
$sql2 .= " order by uid limit $start ,$limit ";
$sql_query = mysql_query($sql2);

/* CREATE THE PAGINATION */

$pagination = "";
if($lastpage > 1)
{ 
    $pagination .= "<ul class='pagination'>";
    if ($page > $counter+1) {
        $pagination.= "<li><a href='#' onclick='setPage(".$prev.")'><<</a></li>"; 
    }

    if ($lastpage < 7 + ($adjacents * 2)) 
    { 
        for ($counter = 1; $counter <= $lastpage; $counter++)
        {
            if ($counter == $page)
                $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
            else
                $pagination.= "<li><a href='#' onclick='setPage(".$counter.")'>$counter</a></li>"; 
        }
    }
    elseif($lastpage > 5 + ($adjacents * 2)) //enough pages to hide some
    {
        //close to beginning; only hide later pages
        if($page < 1 + ($adjacents * 2)) 
        {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                else
                    $pagination.= "<li><a href='#' onclick='setPage(".$counter.")'>$counter</a></li>"; 
            }
            $pagination.= "<li>...</li>";
            $pagination.= "<li><a href='#' onclick='setPage(".$lpm1.")'>$lpm1</a></li>";
            $pagination.= "<li><a href='#' onclick='setPage(".$lastpage.")'>$lastpage</a></li>"; 
        }
        //in middle; hide some front and some back
        elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
        {
            $pagination.= "<li><a href='#' onclick='setPage(1)'>1</a></li>";
            $pagination.= "<li><a href='#' onclick='setPage(2)'>2</a></li>";
            $pagination.= "<li>...</li>";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                else
                    $pagination.= "<li><a href='#' onclick='setPage(".$counter.")'>$counter</a></li>"; 
            }
            $pagination.= "<li>...</li>";
            $pagination.= "<li><a href='#' onclick='setPage(".$lpm1.")'>$lpm1</a></li>";
            $pagination.= "<li><a href='#' onclick='setPage(".$lastpage.")'>$lastpage</a></li>"; 
        }
        //close to end; only hide early pages
        else
        {
            $pagination.= "<li><a href='#' onclick='setPage(1)'>1</a></li>";
            $pagination.= "<li><a href='#' onclick='setPage(2)'>2</a></li>";
            $pagination.= "<li>...</li>";
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; 
            $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<li><a href='#' class='active'>$counter</a></li>";
                else
                    $pagination.= "<li><a href='#' onclick='setPage(".$counter.")'>$counter</a></li>"; 
            }
        }
    }

    //next button
    if ($page < $counter - 1) 
        $pagination.= "<li><li><a href='#' onclick='setPage(".$next.")'>>></a></li>";
    else
        $pagination.= "";
    $pagination.= "</ul>\n"; 
}
echo $pagination;
}

doPaging($page, $table, $where, $rpp, $adjacents, $url = './', $param = '?page=') ;
?>