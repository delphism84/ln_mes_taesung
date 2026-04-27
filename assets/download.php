<?
//include_once($_SERVER["DOCUMENT_ROOT"]."/weberp/common.php"); // 기본 파일
header("Content-type: text/html; charset=UTF-8"); 
//if (!$is_member){
//goto_url("/login.php");
//exit;
//}
extract($_POST);
extract($_GET);
?>

<?php

function mb_basename($path) { return end(explode('/',$path)); } 

function utf2euc($str) { return iconv("UTF-8","cp949//IGNORE", $str); }

function is_ie() {
	if(!isset($_SERVER['HTTP_USER_AGENT']))return false;
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) return true; // IE8
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'Windows NT 6.1') !== false) return true; // IE11
	return false;
}

 //$filepath = './헬로_월드.txt';
 //$filesize = filesize($filepath);
 //$filename = mb_basename($filepath);

// 파일이 있는 디렉토리

	if (!empty($mem_sn)) {
		if ($downtype=="order"){ //주문서
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/order/". $mem_sn."/";
		}else if ($downtype=="salesDaily"){
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/daily/". $mem_sn."/";
		}else if ($downtype=="estimate"){ 
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/estimate/". $mem_sn."/";
		}else if ($downtype=="approval"){ 
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/approval/". $mem_sn."/";
		}else if ($downtype=="estimate"){ 
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/estimate/". $mem_sn."/";
		}else if ($downtype=="moldfile"){ //금형파일
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/mold/". $mem_sn."/";
		}else{
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/";
		}
	} else {
		if ($downtype=="order"){ //주문서
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/order/";
		}else if ($downtype == "salesDaily"){
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/daily/";
		}else if ($downtype == "estimate"){ 
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/estimate/";
		}else if ($downtype == "approval"){ 
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/approval/";
		}else if ($downtype=="estimate"){ 
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/estimate/";
		}else if ($downtype=="moldfile"){ //금형파일
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/mold/";
		}else{
			$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/attach/";
		}
	}
	//$downfiledir = $_SERVER["DOCUMENT_ROOT"]."/userfiles/estimate/". $memberCsn."/";

	// 값 검증
	$downfile  = $_GET["downfile"]; 
	$realname  = $_GET["realname"]; 

	//if( is_ie() ) 
	$filename = utf2euc($realname);

	if ($downfile=="") exit('<script>alert("비 정상접근 입니다.");history.back()</script>');
	
	download_file($downfiledir.$downfile, $filename);
	
    function download_file( $fullPath, $filename ){

		// Must be fresh start
		if( headers_sent() )
			die('Headers Sent');

		// Required for some browsers
		if(ini_get('zlib.output_compression'))
			ini_set('zlib.output_compression', 'Off');

		// File Exists?
		if( file_exists($fullPath) ){

			// Parse Info / Get Extension
			$fsize = filesize($fullPath);
			$path_parts = pathinfo($fullPath);
			$ext = strtolower($path_parts["extension"]);

			// Determine Content Type
			switch ($ext) {
				case "pdf": $ctype="application/pdf"; break;
				case "exe": $ctype="application/octet-stream"; break;
				case "zip": $ctype="application/zip"; break;
				case "doc": $ctype="application/msword"; break;
				case "xls": $ctype="application/vnd.ms-excel"; break;
				case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
				case "gif": $ctype="image/gif"; break;
				case "png": $ctype="image/png"; break;
				case "jpeg":
				case "jpg": $ctype="image/jpg"; break;
				default: $ctype="application/force-download";
			}

			header("Pragma: public"); // required
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false); // required for certain browsers
			header("Content-Type: $ctype");
			header("Content-Disposition: attachment; filename=\"".$filename."\";" );
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".$fsize);
			ob_clean();
			flush();
			readfile( $fullPath );

		} else
			exit('<script>alert("파일을 찾을수 없습니다.");history.back()</script>');

    }
?>