<?
session_start();

extract($_POST);
extract($_GET);

if(!isset($_SESSION['login_id'])) header("Location: login.php");

if($action != "download") {
	if(!isset($_SESSION['login_id'])) {
		session_destroy();
		$controller = 'pages';
		$action = 'login';
		//header("Location: index.php?controller=pages&action=login");
	} else {
		if (isset($controller) && isset($action)) {
			$controller = $controller;
			$action     = $action;
		} else {
			$controller = 'pages';
			$action     = 'home';
		}
	}

	//echo $controller;
	//echo $action;

	require_once ('views/popup_layout.php');
}
?>