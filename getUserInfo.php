<?
// 회원로그인
mysql_connect("localhost","neblog","since1970","neblog") or die ("Connect Error");
mysql_select_db("neblog");

$json_data = $_POST['jsondata'];
$array = json_decode($json_data, true);

foreach($array as $key => $value) {
	switch($key) {
		case "userId" : $userId = $value ; break;
		case "userPwd" : $userPwd = $value ; break;
		default : echo "error" ; break;
	}
}

// AS 설치
$query = "select * from member where userId = '$userId' and userPwd='$userPwd'";
$t = @mysql_fetch_object(@mysql_query($query));

if($t->uid) {
	echo "success";
} else {
	echo "false";
}
?>