<?php

$up_url = 'http://' . $_SERVER['HTTP_HOST'] . '/attach';

$up_dir = './attach'; // 기본 업로드 폴더

 

// GET 파라메타 확인

if (empty($_GET['type'])) {

	$type = '';

} else {

	$type = $_GET['type'];

}


// 업로드 DIALOG 에서 전송된 값

$funcNum = $_GET['CKEditorFuncNum'] ;

$CKEditor = $_GET['CKEditor'] ;

$langCode = $_GET['langCode'] ;




if(isset($_FILES['upload']['tmp_name']))

// 업로드 파일이 있을 경우에만

{

	$org_file_name = $_FILES['upload']['name'];

	$file_name = $org_file_name;

	$ext = strtolower(substr($file_name, (strrpos($file_name, '.') + 1)));

 

 	// 확장자 확인

	if ('image' == $type) {

		if ('jpg' != $ext && 'jpeg' != $ext && 'gif' != $ext && 'png' != $ext) {

			echo '<script type="text/javascript">alert("확장자가 올바르지 않습니다.\n.jpg, .gif, .png 파일만 업로드 가능합니다.");history.back();</script>';

			return false;

		}

	} else if ('flash' == $type) {

		if ('swf' != $ext) {

			echo '<script type="text/javascript">alert("확장자가 올바르지 않습니다.\n.swf 파일만 업로드 가능합니다.");history.back();</script>';

			return false;

		}

	}

 

  	// 한글파일명일 경우 임의의 파일명으로 변경

	if(preg_match('/[\xA1-\xFE]/', $file_name)){

		$file_name = uniqid() . '.' . $ext;

	}

	

	$save_dir = sprintf('%s/%s', $up_dir, $file_name);

	$save_url = sprintf('%s/%s', $up_url, $file_name);

 

	if (file_exists($save_dir)) {

 	// 파일명 중복시 파일명을 다시 구한다.

		do {

			$file_name = uniqid() . '.' . $ext;

			$save_dir = sprintf('%s/%s', $up_dir, $file_name);

			$save_url = sprintf('%s/%s', $up_url, $file_name);			

		} while(file_exists($save_dir));

	}

	

	if ($file_name == $org_file_name) {

		$message = '업로드가 완료되었습니다.';

	} else {

		$message = sprintf('업로드 시 파일명이 변경되었습니다.(%s => %s)', $org_file_name, $file_name);

	}




	if (move_uploaded_file($_FILES["upload"]["tmp_name"],$save_dir)) {

 	//  업로드가 완료된 경우

		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$save_url', '$message');</script>";

	}

}

?>
