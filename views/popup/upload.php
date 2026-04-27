<?
$title = "수주(주문서) 리스트";
require_once("../../connection.php");
require_once("../../assets/phead.php");
require_once("../../library/function.php");

extract($_POST);
extract($_GET);


@mkdir("attach/mold/", 0777);

// define absolute folder path
$storeFolder = "attach/mold/";
// if folder doesn't exists, create it
chmod("$storeFolder", 0777);

if(!file_exists($storeFolder) && !is_dir($storeFolder)) {
    mkdir($storeFolder);
}

	// upload files to $storeFolder
	if (!empty($_FILES)) {
		
		/**
		 *  uploadMultiple = false
		 *  When uploading file by file, upload on fly
		 *  
		 */
		// $tempFile = $_FILES['file']['tmp_name'];        
		// $targetFile =  $storeFolders . $_FILES['file']['name'];
		// move_uploaded_file($tempFile,$targetFile); 
		
	   /**
		 *  uploadMultiple = true
		 *  When uploading multiple files in a single request.
		 *  Way to go if using dropzone in a form with other fields,
		 *  and when uploading files on form submit via button... myDropzone.processQueue(); 
		 *
		 *  $_FILES['file']['tmp_name'] is an array so have to use loop
		 *
		 */
		 $prefix = time(); //파일명 앞에 자동으로 붙을 단어
		
		foreach($_FILES['file']['tmp_name'] as $key => $value) {
			$tempFile = $_FILES['file']['tmp_name'][$key];
			$newfile = $prefix.$_FILES['file']['name'][$key];
			$targetFile =  $storeFolder.$newfile ;

			move_uploaded_file($tempFile,$targetFile);

			$sql="INSERT INTO erp_mold_file (fid, file_name, regdate) VALUES('".$fid."','".$newfile."','".date("Y-m-d H:i:s")."')";
			echo $sql."<BR>"; 
			$result = mysql_query($sql);

	}

}

?>