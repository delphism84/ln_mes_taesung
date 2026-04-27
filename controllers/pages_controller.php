<?
session_start();

class PagesController {
	public function __construct() {
	}

	public function movePage($controller,$action) {
		echo "<script>";
		echo "location.href = 'index.php?controller=".$controller."&action=".$action."' ";
		echo "</script>";
	}

	// 거래처 리스트
	public function home(){
		require_once ('views/pages/home.php');
	}
	
	// 거래처 등록
	public function error(){
		require_once ("views/pages/error.php");
	}
}
?>