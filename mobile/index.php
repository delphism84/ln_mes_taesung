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

	require_once ('views/layout.php');
} else {
	$filepath = "./attach/".$file;
	$filesize = filesize($filepath);
	$path_parts = pathinfo($filepath);
	$filename = $path_parts['basename'];
	$extension = $path_parts['extension'];

	header("Pragma: public");
	header("Expires: 0");
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=\"$filename\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: $filesize");

	ob_clean();
	flush();
	readfile($filepath);	
}

?>