<?
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
header("Pragma: no-cache");
header("Cache-Control: no-store, no-cache, must-revalidate"); 

extract($_POST);
extract($_GET);

//$barcode = "123456789";

require('class/BCGFontFile.php');
//require('class/BCGColor.php');
require('class/BCGDrawing.php');
require('class/BCGcode128.barcode.php');

$font = new BCGFontFile('./font/Arial.ttf', 8);
$colorFront = new BCGColor(0, 0, 0);
$colorBack = new BCGColor(255, 255, 255);

// Barcode Part
$code = new BCGcode128();
$code->setScale(1);
$code->setThickness(40);
$code->setForegroundColor($colorFront);
$code->setBackgroundColor($colorBack);
$code->setFont($font);
$code->setStart(NULL);
$code->setTilde(true);
$code->parse($barcode);

// Drawing Part
$drawing = new BCGDrawing('', $colorBack);
$drawing->setBarcode($code);
$drawing->draw();


//header('Content-Type: image/png');
header('Content-Type: image/jpeg');

$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
?>