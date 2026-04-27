<?
session_start();
unset($_SESSION['login_id']);
if(!isset($_SESSION['login_id'])) header("Location:index.php");
else echo $_SESSION['login_id'];
?>