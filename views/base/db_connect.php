
<?
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = mysql_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysql_connect_error());
/* check connection */
if (mysql_connect_errno()) {
    printf("Connect failed: %s\n", mysql_connect_error());
    exit();
}
?>